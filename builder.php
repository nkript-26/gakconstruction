<?php

echo "🛠️ Starting GAK Construction Project Builder...\n";

$files = [];

// ------------------------------------------------------------------
// 1. MIGRATIONS
// ------------------------------------------------------------------

$files['database/migrations/2024_01_01_000001_create_hero_banners_table.php'] = <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->string('image');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_banners');
    }
};
PHP;

$files['database/migrations/2024_01_01_000002_create_projects_table.php'] = <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('location');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('category')->nullable();
            $table->date('completion_date')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
PHP;

$files['database/migrations/2024_01_01_000003_create_services_table.php'] = <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->string('icon')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
PHP;

$files['database/migrations/2024_01_01_000004_create_contacts_table.php'] = <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->text('requirements');
            $table->enum('status', ['new', 'read', 'replied'])->default('new');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
PHP;

// ------------------------------------------------------------------
// 2. MODELS
// ------------------------------------------------------------------

$files['app/Models/HeroBanner.php'] = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroBanner extends Model
{
    protected $fillable = ['title', 'subtitle', 'image', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
PHP;

$files['app/Models/Project.php'] = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_name', 'location', 'description', 'image',
        'category', 'completion_date', 'is_featured'
    ];

    protected $casts = [
        'completion_date' => 'date',
        'is_featured' => 'boolean',
    ];
}
PHP;

$files['app/Models/Service.php'] = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'description', 'image', 'icon', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
PHP;

$files['app/Models/Contact.php'] = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'mobile', 'requirements', 'status'];
}
PHP;

// ------------------------------------------------------------------
// 3. FILAMENT RESOURCES (WITH EXACT COMPATIBLE TYPE HINTS)
// ------------------------------------------------------------------

$files['app/Filament/Resources/HeroBannerResource.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroBannerResource\Pages;
use App\Models\HeroBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HeroBannerResource extends Resource
{
    protected static ?string $model = HeroBanner::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-photo';
    protected static string | \UnitEnum | null $navigationGroup = 'Website Content';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero Banner Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')->required()->maxLength(255),
                        Forms\Components\Textarea::make('subtitle')->rows(3)->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')
                            ->image()->required()->directory('hero-banners')
                            ->imageEditor()->imageResizeMode('cover')->imageCropAspectRatio('16:9')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('order')->numeric()->default(0),
                        Forms\Components\Toggle::make('is_active')->default(true)->label('Active'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->square()->size(80),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('order')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Active'),
            ])
            ->defaultSort('order', 'asc')
            ->actions([ Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make(), ])
            ->bulkActions([ Tables\Actions\BulkActionGroup::make([ Tables\Actions\DeleteBulkAction::make(), ]), ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroBanners::route('/'),
            'create' => Pages\CreateHeroBanner::route('/create'),
            'edit' => Pages\EditHeroBanner::route('/{record}/edit'),
        ];
    }
}
PHP;

$files['app/Filament/Resources/HeroBannerResource/Pages/ListHeroBanners.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources\HeroBannerResource\Pages;

use App\Filament\Resources\HeroBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHeroBanners extends ListRecords
{
    protected static string $resource = HeroBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [ Actions\CreateAction::make(), ];
    }
}
PHP;

$files['app/Filament/Resources/HeroBannerResource/Pages/CreateHeroBanner.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources\HeroBannerResource\Pages;

use App\Filament\Resources\HeroBannerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHeroBanner extends CreateRecord
{
    protected static string $resource = HeroBannerResource::class;
}
PHP;

$files['app/Filament/Resources/HeroBannerResource/Pages/EditHeroBanner.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources\HeroBannerResource\Pages;

use App\Filament\Resources\HeroBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHeroBanner extends EditRecord
{
    protected static string $resource = HeroBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [ Actions\DeleteAction::make(), ];
    }
}
PHP;

$files['app/Filament/Resources/ProjectResource.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-office-2';
    protected static string | \UnitEnum | null $navigationGroup = 'Website Content';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Project Information')
                    ->schema([
                        Forms\Components\TextInput::make('project_name')->required()->maxLength(255),
                        Forms\Components\TextInput::make('location')->required(),
                        Forms\Components\Select::make('category')->options([
                            'Residential' => 'Residential', 'Commercial' => 'Commercial',
                            'Industrial' => 'Industrial', 'Infrastructure' => 'Infrastructure',
                        ]),
                        Forms\Components\DatePicker::make('completion_date')->native(false),
                        Forms\Components\Textarea::make('description')->rows(4)->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')->image()->required()->directory('projects')->imageEditor()->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->square()->size(80),
                Tables\Columns\TextColumn::make('project_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('location')->searchable(),
                Tables\Columns\TextColumn::make('completion_date')->date('M Y')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([ Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make(), ])
            ->bulkActions([ Tables\Actions\BulkActionGroup::make([ Tables\Actions\DeleteBulkAction::make(), ]), ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
PHP;

$files['app/Filament/Resources/ProjectResource/Pages/ListProjects.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [ Actions\CreateAction::make(), ];
    }
}
PHP;

$files['app/Filament/Resources/ProjectResource/Pages/CreateProject.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;
}
PHP;

$files['app/Filament/Resources/ProjectResource/Pages/EditProject.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [ Actions\DeleteAction::make(), ];
    }
}
PHP;

$files['app/Filament/Resources/ServiceResource.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string | \UnitEnum | null $navigationGroup = 'Website Content';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Service Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')->required()->maxLength(255),
                        Forms\Components\Textarea::make('description')->rows(5)->required()->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')->image()->required()->directory('services')->imageEditor()->columnSpanFull(),
                        Forms\Components\TextInput::make('order')->numeric()->default(0),
                        Forms\Components\Toggle::make('is_active')->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->square()->size(80),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('order')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->defaultSort('order', 'asc')
            ->actions([ Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make(), ])
            ->bulkActions([ Tables\Actions\BulkActionGroup::make([ Tables\Actions\DeleteBulkAction::make(), ]), ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
PHP;

$files['app/Filament/Resources/ServiceResource/Pages/ListServices.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [ Actions\CreateAction::make(), ];
    }
}
PHP;

$files['app/Filament/Resources/ServiceResource/Pages/CreateService.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;
}
PHP;

$files['app/Filament/Resources/ServiceResource/Pages/EditService.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [ Actions\DeleteAction::make(), ];
    }
}
PHP;

$files['app/Filament/Resources/ContactResource.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-envelope';
    protected static string | \UnitEnum | null $navigationGroup = 'Communications';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'new')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contact Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\TextInput::make('email')->email()->required(),
                        Forms\Components\TextInput::make('mobile')->required(),
                        Forms\Components\Select::make('status')
                            ->options(['new' => 'New', 'read' => 'Read', 'replied' => 'Replied'])->required(),
                        Forms\Components\Textarea::make('requirements')->rows(5)->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()->weight('bold'),
                Tables\Columns\TextColumn::make('email')->searchable()->copyable(),
                Tables\Columns\TextColumn::make('mobile')->copyable(),
                Tables\Columns\BadgeColumn::make('status')->colors(['danger' => 'new', 'warning' => 'read', 'success' => 'replied']),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y, H:i')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\Action::make('mark_read')
                    ->icon('heroicon-o-check')->color('success')
                    ->visible(fn ($record) => $record->status === 'new')
                    ->action(function ($record) {
                        $record->update(['status' => 'read']);
                        Notification::make()->title('Marked as read')->success()->send();
                    }),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([ Tables\Actions\BulkActionGroup::make([ Tables\Actions\DeleteBulkAction::make(), ]), ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
PHP;

$files['app/Filament/Resources/ContactResource/Pages/ListContacts.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [ Actions\CreateAction::make(), ];
    }
}
PHP;

$files['app/Filament/Resources/ContactResource/Pages/CreateContact.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContact extends CreateRecord
{
    protected static string $resource = ContactResource::class;
}
PHP;

$files['app/Filament/Resources/ContactResource/Pages/EditContact.php'] = <<<'PHP'
<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContact extends EditRecord
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [ Actions\DeleteAction::make(), ];
    }
}
PHP;

// ------------------------------------------------------------------
// 4. MAILERS & CONTROLLER
// ------------------------------------------------------------------

$files['app/Mail/ContactAdminMail.php'] = <<<'PHP'
<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🔔 New Contact Request from ' . $this->contact->name,
            replyTo: [$this->contact->email],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-admin',
            with: ['contact' => $this->contact],
        );
    }
}
PHP;

$files['app/Mail/ContactClientMail.php'] = <<<'PHP'
<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactClientMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank You for Contacting GAK Construction',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-client',
            with: ['contact' => $this->contact],
        );
    }
}
PHP;

$files['app/Http/Controllers/PageController.php'] = <<<'PHP'
<?php

namespace App\Http\Controllers;

use App\Models\HeroBanner;
use App\Models\Project;
use App\Models\Service;
use App\Models\Contact;
use App\Mail\ContactAdminMail;
use App\Mail\ContactClientMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function home()
    {
        $banners = HeroBanner::where('is_active', true)->orderBy('order')->get();
        $services = Service::where('is_active', true)->orderBy('order')->take(6)->get();
        $projects = Project::orderBy('created_at', 'desc')->take(6)->get();

        return view('pages.home', compact('banners', 'services', 'projects'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        return view('pages.services', compact('services'));
    }

    public function projects()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        return view('pages.projects', compact('projects'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'requirements' => 'required|string|max:2000',
        ]);

        $contact = Contact::create($validated);

        try {
            $adminEmail = env('ADMIN_EMAIL', 'admin@gakconstruction.com');
            Mail::to($adminEmail)->send(new ContactAdminMail($contact));
            Mail::to($contact->email)->send(new ContactClientMail($contact));
        } catch (\Exception $e) {
            \Log::error('Mail error: ' . $e->getMessage());
        }

        return redirect()->route('contact')->with('success', 'Thank you! Your message has been sent. We will contact you soon.');
    }
}
PHP;

// ------------------------------------------------------------------
// 5. ROUTES
// ------------------------------------------------------------------

$files['routes/web.php'] = <<<'PHP'
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/projects', [PageController::class, 'projects'])->name('projects');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');
PHP;

// ------------------------------------------------------------------
// 6. BLADE VIEWS & STYLES
// ------------------------------------------------------------------

$files['resources/views/layouts/app.blade.php'] = <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GAK Construction')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@include('partials.header')

@yield('content')

@include('partials.footer')

<script>
    window.addEventListener('scroll', () => {
        document.getElementById('mainHeader').classList.toggle('scrolled', window.scrollY > 50);
    });
    document.getElementById('hamburger').addEventListener('click', () => {
        document.getElementById('navMenu').classList.toggle('active');
    });
</script>
</body>
</html>
HTML;

$files['resources/views/partials/header.blade.php'] = <<<'HTML'
<header class="main-header" id="mainHeader">
    <div class="header-container">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="GAK" class="logo-img" onerror="this.src='https://via.placeholder.com/150x50?text=GAK'">
            <div class="logo-text">
                <span class="logo-name">GAK</span>
                <span class="logo-tagline">CONSTRUCTION</span>
            </div>
        </a>

        <nav class="main-nav" id="navMenu">
            <ul class="nav-list">
                <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"><i class="fas fa-info-circle"></i> About</a></li>
                <li><a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}"><i class="fas fa-cogs"></i> Services</a></li>
                <li><a href="{{ route('projects') }}" class="nav-link {{ request()->routeIs('projects') ? 'active' : '' }}"><i class="fas fa-building"></i> Projects</a></li>
                <li><a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"><i class="fas fa-envelope"></i> Contact</a></li>
            </ul>
            <a href="{{ route('contact') }}" class="nav-cta-btn"><i class="fas fa-phone"></i> Get Quote</a>
        </nav>

        <button class="hamburger" id="hamburger"><i class="fas fa-bars"></i></button>
    </div>
</header>
HTML;

$files['resources/views/partials/footer.blade.php'] = <<<'HTML'
<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-col">
            <h3>GAK Construction</h3>
            <p>Building quality structures with over 15 years of experience.</p>
        </div>
        <div class="footer-col">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('services') }}">Services</a></li>
                <li><a href="{{ route('projects') }}">Projects</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>Contact</h3>
            <p><i class="fas fa-map-marker-alt"></i> Colombo, Sri Lanka</p>
            <p><i class="fas fa-phone"></i> +94 77 123 4567</p>
            <p><i class="fas fa-envelope"></i> info@gakconstruction.com</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} GAK Construction. All Rights Reserved.</p>
    </div>
</footer>
HTML;

$files['resources/views/partials/hero.blade.php'] = <<<'HTML'
<section class="hero-section">
    <div class="hero-slider">
        @forelse($banners as $index => $banner)
            <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" 
                 style="background-image: url('{{ asset('storage/' . $banner->image) }}');">
                <div class="hero-overlay"></div>
                <div class="hero-content">
                    <div class="hero-badge"><i class="fas fa-hard-hat"></i> GAK Construction</div>
                    <h1 class="hero-title">{{ $banner->title }}</h1>
                    <p class="hero-description">{{ $banner->subtitle }}</p>
                    <div class="hero-buttons">
                        <a href="{{ route('services') }}" class="btn btn-primary">Our Services</a>
                        <a href="{{ route('contact') }}" class="btn btn-outline">Contact Us</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="hero-slide active" style="background-image: url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1920');">
                <div class="hero-overlay"></div>
                <div class="hero-content">
                    <div class="hero-badge"><i class="fas fa-hard-hat"></i> GAK Construction</div>
                    <h1 class="hero-title">Building Your <span style="color:#e74c3c">Dreams</span></h1>
                    <p class="hero-description">Please add hero banners from the admin panel.</p>
                    <div class="hero-buttons">
                        <a href="{{ route('services') }}" class="btn btn-primary">Services</a>
                        <a href="{{ route('contact') }}" class="btn btn-outline">Contact</a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelectorAll('.hero-slide');
    if (slides.length > 1) {
        let current = 0;
        setInterval(() => {
            slides[current].classList.remove('active');
            current = (current + 1) % slides.length;
            slides[current].classList.add('active');
        }, 5000);
    }
});
</script>
HTML;

$files['resources/views/pages/home.blade.php'] = <<<'HTML'
@extends('layouts.app')
@section('title', 'GAK Construction - Home')

@section('content')
@include('partials.hero')

<section class="section bg-light">
    <div class="container text-center">
        <h4 class="text-red">What We Offer</h4>
        <h2>Our Services</h2>
        <div class="services-grid mt-4">
            @forelse($services as $service)
                <div class="service-card">
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="service-img">
                    <h3>{{ $service->title }}</h3>
                    <p>{{ Str::limit($service->description, 100) }}</p>
                </div>
            @empty
                <p>No services added yet.</p>
            @endforelse
        </div>
        <br>
        <a href="{{ route('services') }}" class="btn btn-primary">View All Services</a>
    </div>
</section>

<section class="section">
    <div class="container text-center">
        <h4 class="text-red">Our Portfolio</h4>
        <h2>Recent Projects</h2>
        <div class="projects-grid mt-4">
            @forelse($projects as $project)
                <div class="project-card">
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->project_name }}">
                    <div class="project-info">
                        <h3>{{ $project->project_name }}</h3>
                        <p><i class="fas fa-map-marker-alt"></i> {{ $project->location }}</p>
                    </div>
                </div>
            @empty
                <p>No projects added yet.</p>
            @endforelse
        </div>
        <br>
        <a href="{{ route('projects') }}" class="btn btn-primary">View All Projects</a>
    </div>
</section>
@endsection
HTML;

$files['resources/views/pages/services.blade.php'] = <<<'HTML'
@extends('layouts.app')
@section('title', 'Services - GAK Construction')

@section('content')
<section class="page-banner" style="background-image:url('https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=1920');">
    <div class="banner-overlay"></div>
    <div class="banner-content"><h1>Our Services</h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="services-grid">
            @forelse($services as $service)
                <div class="service-card">
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="service-img">
                    <h3>{{ $service->title }}</h3>
                    <p>{!! nl2br(e($service->description)) !!}</p>
                </div>
            @empty
                <p class="text-center">No services added yet.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
HTML;

$files['resources/views/pages/projects.blade.php'] = <<<'HTML'
@extends('layouts.app')
@section('title', 'Projects - GAK Construction')

@section('content')
<section class="page-banner" style="background-image:url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1920');">
    <div class="banner-overlay"></div>
    <div class="banner-content"><h1>Completed Projects</h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="projects-grid">
            @forelse($projects as $project)
                <div class="project-card">
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->project_name }}">
                    <div class="project-info">
                        <h3>{{ $project->project_name }}</h3>
                        <p><i class="fas fa-map-marker-alt"></i> {{ $project->location }}</p>
                        @if($project->description)
                            <p>{{ $project->description }}</p>
                        @endif
                        @if($project->completion_date)
                            <p><i class="fas fa-calendar"></i> {{ $project->completion_date->format('M Y') }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-center">No projects added yet.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
HTML;

$files['resources/views/pages/about.blade.php'] = <<<'HTML'
@extends('layouts.app')
@section('title', 'About - GAK Construction')

@section('content')
<section class="page-banner" style="background-image:url('https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=1920');">
    <div class="banner-overlay"></div>
    <div class="banner-content"><h1>About Us</h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="text-center" style="max-width:800px;margin:0 auto;">
            <h4 class="text-red">Our Story</h4>
            <h2>Building Excellence Since 2009</h2>
            <br>
            <p>GAK Construction was founded with a vision to deliver top-quality construction services. We are committed to delivering exceptional quality in every project.</p>
        </div>
        <div class="mission-vision mt-4">
            <div class="mv-card">
                <h3><i class="fas fa-bullseye text-red"></i> Our Mission</h3>
                <p>To deliver exceptional construction services that exceed client expectations.</p>
            </div>
            <div class="mv-card">
                <h3><i class="fas fa-eye text-red"></i> Our Vision</h3>
                <p>To be the most trusted construction company, building a better future.</p>
            </div>
        </div>
    </div>
</section>
@endsection
HTML;

$files['resources/views/pages/contact.blade.php'] = <<<'HTML'
@extends('layouts.app')
@section('title', 'Contact - GAK Construction')

@section('content')
<section class="page-banner" style="background-image:url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=1920');">
    <div class="banner-overlay"></div>
    <div class="banner-content"><h1>Contact Us</h1></div>
</section>

<section class="section">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info">
                <h4 class="text-red">Get In Touch</h4>
                <h2>Let's Build Together</h2>
                <p>Have a construction project in mind? Reach out to us!</p>

                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div><h4>Address</h4><p>123 Construction Lane, Colombo</p></div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <div><h4>Phone</h4><p>+94 77 123 4567</p></div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div><h4>Email</h4><p>info@gakconstruction.com</p></div>
                </div>
            </div>

            <div class="contact-form-box">
                <h3>Send Us a Message</h3>

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.submit') }}">
                    @csrf
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Full Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="your@email.com">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-phone"></i> Mobile *</label>
                        <input type="tel" name="mobile" value="{{ old('mobile') }}" required placeholder="+94 77 123 4567">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-comment"></i> Your Requirements *</label>
                        <textarea name="requirements" rows="5" required placeholder="Tell us about your project...">{{ old('requirements') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
HTML;

$files['resources/views/emails/contact-admin.blade.php'] = <<<'HTML'
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>New Contact Request</title></head>
<body style="font-family:Arial,sans-serif;background:#f4f4f4;padding:20px;margin:0;">
    <div style="max-width:600px;margin:auto;background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,0.1);">
        <div style="background:linear-gradient(135deg,#c0392b,#e74c3c);color:#fff;padding:30px;text-align:center;">
            <h1 style="margin:0;">🔔 New Contact Request</h1>
            <p style="margin:10px 0 0;">You have a new inquiry!</p>
        </div>

        <div style="padding:30px;">
            <table style="width:100%;border-collapse:collapse;">
                <tr>
                    <td style="padding:12px;background:#f8f9fa;border-bottom:1px solid #eee;width:140px;"><strong>👤 Name:</strong></td>
                    <td style="padding:12px;border-bottom:1px solid #eee;">{{ $contact->name }}</td>
                </tr>
                <tr>
                    <td style="padding:12px;background:#f8f9fa;border-bottom:1px solid #eee;"><strong>📧 Email:</strong></td>
                    <td style="padding:12px;border-bottom:1px solid #eee;">
                        <a href="mailto:{{ $contact->email }}" style="color:#c0392b;">{{ $contact->email }}</a>
                    </td>
                </tr>
                <tr>
                    <td style="padding:12px;background:#f8f9fa;border-bottom:1px solid #eee;"><strong>📱 Mobile:</strong></td>
                    <td style="padding:12px;border-bottom:1px solid #eee;">
                        <a href="tel:{{ $contact->mobile }}" style="color:#c0392b;">{{ $contact->mobile }}</a>
                    </td>
                </tr>
                <tr>
                    <td style="padding:12px;background:#f8f9fa;border-bottom:1px solid #eee;vertical-align:top;"><strong>📝 Requirements:</strong></td>
                    <td style="padding:12px;border-bottom:1px solid #eee;">{!! nl2br(e($contact->requirements)) !!}</td>
                </tr>
            </table>

            <div style="margin-top:25px;padding:15px;background:#fff3cd;border-left:4px solid #ffc107;border-radius:5px;">
                <strong>⏰ Received:</strong> {{ $contact->created_at->format('d M Y, h:i A') }}
            </div>

            <div style="text-align:center;margin-top:25px;">
                <a href="{{ url('/admin/contacts') }}" style="background:#c0392b;color:#fff;padding:12px 30px;text-decoration:none;border-radius:5px;display:inline-block;">
                    View in Admin Panel
                </a>
            </div>
        </div>

        <div style="background:#1a1a2e;color:#aaa;padding:15px;text-align:center;font-size:12px;">
            © {{ date('Y') }} GAK Construction Admin Panel
        </div>
    </div>
</body>
</html>
HTML;

$files['resources/views/emails/contact-client.blade.php'] = <<<'HTML'
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Thank You</title></head>
<body style="font-family:Arial,sans-serif;background:#f4f4f4;padding:20px;margin:0;">
    <div style="max-width:600px;margin:auto;background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,0.1);">
        <div style="background:linear-gradient(135deg,#c0392b,#e74c3c);color:#fff;padding:40px;text-align:center;">
            <h1 style="margin:0;">✅ Thank You, {{ $contact->name }}!</h1>
            <p style="margin:10px 0 0;font-size:16px;">Your inquiry has been received</p>
        </div>

        <div style="padding:30px;">
            <p style="font-size:16px;color:#333;">Dear <strong>{{ $contact->name }}</strong>,</p>
            <p style="color:#555;line-height:1.7;">
                Thank you for reaching out to <strong>GAK Construction</strong>. We have received your inquiry
                and our team will contact you within <strong>24 hours</strong>.
            </p>

            <h3 style="color:#c0392b;border-bottom:2px solid #c0392b;padding-bottom:8px;margin-top:25px;">
                📋 Your Submission Details
            </h3>

            <table style="width:100%;border-collapse:collapse;margin-top:15px;">
                <tr>
                    <td style="padding:10px;background:#f8f9fa;width:130px;"><strong>Name:</strong></td>
                    <td style="padding:10px;">{{ $contact->name }}</td>
                </tr>
                <tr>
                    <td style="padding:10px;background:#f8f9fa;"><strong>Email:</strong></td>
                    <td style="padding:10px;">{{ $contact->email }}</td>
                </tr>
                <tr>
                    <td style="padding:10px;background:#f8f9fa;"><strong>Mobile:</strong></td>
                    <td style="padding:10px;">{{ $contact->mobile }}</td>
                </tr>
                <tr>
                    <td style="padding:10px;background:#f8f9fa;vertical-align:top;"><strong>Requirements:</strong></td>
                    <td style="padding:10px;">{!! nl2br(e($contact->requirements)) !!}</td>
                </tr>
            </table>

            <div style="margin-top:30px;padding:20px;background:#f8f9fa;border-radius:8px;text-align:center;">
                <p style="margin:0;color:#333;"><strong>📞 Need urgent assistance?</strong></p>
                <p style="margin:5px 0;color:#c0392b;font-size:20px;"><strong>+94 77 123 4567</strong></p>
                <p style="margin:5px 0;color:#666;font-size:14px;">Mon - Sat: 8:00 AM - 6:00 PM</p>
            </div>

            <p style="margin-top:30px;color:#555;">
                Best Regards,<br>
                <strong>GAK Construction Team</strong>
            </p>
        </div>

        <div style="background:#1a1a2e;color:#aaa;padding:20px;text-align:center;font-size:12px;">
            © {{ date('Y') }} GAK Construction. All Rights Reserved.<br>
            123 Construction Lane, Colombo, Sri Lanka
        </div>
    </div>
</body>
</html>
HTML;

$files['public/css/style.css'] = <<<'CSS'
:root {
    --primary-red: #c0392b;
    --dark: #1a1a2e;
    --white: #fff;
    --gray: #6c757d;
    --light-gray: #f8f9fa;
}

* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Poppins',sans-serif; color:#333; line-height:1.6; }
a { text-decoration:none; }

.text-red { color: var(--primary-red); }
.bg-light { background: var(--light-gray); }
.text-center { text-align: center; }
.mt-4 { margin-top: 40px; }

.container { max-width:1200px; margin:0 auto; padding:0 20px; }
.section { padding: 80px 0; }

/* Buttons */
.btn { padding:12px 30px; display:inline-block; font-weight:600; border-radius:5px; transition:0.3s; cursor:pointer; border:2px solid transparent; }
.btn-primary { background: var(--primary-red); color: white; border-color: var(--primary-red); }
.btn-primary:hover { background: #96281b; }
.btn-outline { background: transparent; color: white; border-color: white; }
.btn-outline:hover { background: white; color: var(--primary-red); }
.btn-block { width: 100%; text-align: center; }

/* Header */
.main-header { position:fixed; top:0; left:0; width:100%; background:rgba(26,26,46,0.95); z-index:1000; padding:15px 0; transition:0.3s; }
.main-header.scrolled { padding:10px 0; box-shadow:0 4px 10px rgba(0,0,0,0.3); }
.header-container { max-width:1200px; margin:0 auto; padding:0 20px; display:flex; justify-content:space-between; align-items:center; }
.logo { display:flex; align-items:center; gap:10px; }
.logo-img { height:50px; }
.logo-name { color:var(--primary-red); font-weight:900; font-size:24px; display:block; line-height:1; }
.logo-tagline { color:#ccc; font-size:10px; letter-spacing:2px; }
.main-nav { display:flex; align-items:center; gap:20px; }
.nav-list { display:flex; list-style:none; gap:20px; }
.nav-link { color:white; font-weight:500; transition:0.3s; }
.nav-link:hover, .nav-link.active { color: var(--primary-red); }
.nav-cta-btn { background: var(--primary-red); color:white; padding:8px 20px; border-radius:20px; font-weight:bold; }
.hamburger { display:none; background:none; border:none; color:white; font-size:24px; cursor:pointer; }

/* Hero */
.hero-section { position:relative; height:100vh; overflow:hidden; }
.hero-slider { position:relative; width:100%; height:100%; }
.hero-slide { position:absolute; top:0; left:0; width:100%; height:100%; background-size:cover; background-position:center; opacity:0; transition:opacity 1.5s ease; display:flex; align-items:center; justify-content:center; }
.hero-slide.active { opacity:1; }
.hero-overlay { position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1; }
.hero-content { position:relative; z-index:2; max-width:800px; padding:0 20px; text-align:center; color:white; }
.hero-title { font-size:4rem; font-weight:900; margin:20px 0; line-height:1.2; }
.hero-description { font-size:1.2rem; margin-bottom:30px; color:#ddd; }
.hero-badge { display:inline-block; background:rgba(192,57,43,0.2); border:1px solid var(--primary-red); color:var(--primary-red); padding:8px 20px; border-radius:30px; font-weight:bold; }
.hero-buttons { display:flex; gap:15px; justify-content:center; }

/* Services Grid */
.services-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:30px; }
.service-card { background:white; padding:30px; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.05); transition:0.3s; text-align:center; }
.service-card:hover { transform:translateY(-10px); }
.service-img { width:100%; height:200px; object-fit:cover; border-radius:8px; margin-bottom:15px; }
.service-card h3 { margin-bottom:10px; color:var(--dark); }

/* Projects Grid */
.projects-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:30px; margin-top:30px; }
.project-card { background:white; border-radius:10px; overflow:hidden; box-shadow:0 5px 20px rgba(0,0,0,0.08); transition:0.3s; }
.project-card:hover { transform:translateY(-10px); }
.project-card img { width:100%; height:250px; object-fit:cover; }
.project-info { padding:20px; text-align:left; }
.project-info h3 { margin-bottom:10px; color:var(--dark); }
.project-info p { color:#666; margin-bottom:5px; }
.project-info i { color:var(--primary-red); margin-right:5px; }

/* Page Banner */
.page-banner { height:350px; position:relative; display:flex; align-items:center; justify-content:center; background-size:cover; background-position:center; margin-top:70px; }
.banner-overlay { position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); }
.banner-content { position:relative; z-index:2; color:white; text-align:center; }
.banner-content h1 { font-size:3rem; }

/* About */
.mission-vision { display:grid; grid-template-columns:1fr 1fr; gap:30px; }
.mv-card { background:var(--light-gray); padding:30px; border-radius:10px; border-top:4px solid var(--primary-red); }

/* Contact */
.contact-grid { display:grid; grid-template-columns:1fr 1fr; gap:50px; }
.contact-item { display:flex; gap:15px; margin-bottom:20px; align-items:flex-start; }
.contact-item i { font-size:24px; color:var(--primary-red); width:50px; height:50px; background:var(--light-gray); border-radius:50%; display:flex; align-items:center; justify-content:center; }
.contact-item h4 { margin-bottom:3px; }
.contact-form-box { background:white; padding:35px; border-radius:15px; box-shadow:0 10px 30px rgba(0,0,0,0.08); }
.contact-form-box h3 { margin-bottom:20px; color:var(--dark); }
.form-group { margin-bottom:15px; }
.form-group label { display:block; margin-bottom:5px; font-weight:600; font-size:14px; }
.form-group label i { color:var(--primary-red); margin-right:5px; }
.form-group input, .form-group textarea { width:100%; padding:12px 15px; border:2px solid #e0e0e0; border-radius:8px; font-size:14px; font-family:inherit; }
.form-group input:focus, .form-group textarea:focus { outline:none; border-color:var(--primary-red); }
.alert { padding:15px; border-radius:8px; margin-bottom:20px; }
.alert-success { background:#d4edda; color:#155724; border:1px solid #c3e6cb; }
.alert-error { background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; }

/* Footer */
.main-footer { background:var(--dark); color:#aaa; padding-top:60px; }
.footer-container { max-width:1200px; margin:0 auto; padding:0 20px; display:grid; grid-template-columns:repeat(3,1fr); gap:40px; }
.footer-col h3 { color:white; margin-bottom:20px; }
.footer-col ul { list-style:none; }
.footer-col ul li { margin-bottom:10px; }
.footer-col ul a { color:#aaa; }
.footer-col ul a:hover { color:var(--primary-red); }
.footer-bottom { text-align:center; padding:20px 0; border-top:1px solid rgba(255,255,255,0.1); margin-top:40px; }

/* Responsive */
@media (max-width:768px) {
    .hamburger { display:block; }
    .main-nav { display:none; position:absolute; top:100%; left:0; width:100%; background:var(--dark); flex-direction:column; padding:20px 0; text-align:center; }
    .main-nav.active { display:flex; }
    .nav-list { flex-direction:column; }
    .hero-title { font-size:2.5rem; }
    .hero-buttons { flex-direction:column; padding:0 20px; }
    .services-grid, .projects-grid, .footer-container, .mission-vision, .contact-grid { grid-template-columns:1fr; }
}
CSS;

// Write all files
foreach ($files as $path => $content) {
    $dir = dirname($path);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    file_put_contents($path, $content);
    echo "  [✓] Generated: {$path}\n";
}

echo "\n✨ Project files generated successfully!\n";
PHP;