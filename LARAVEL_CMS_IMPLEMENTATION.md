# Laravel CMS Implementation Guide
## Ocean Dental Landing Page - Dynamic CMS with Laravel & Filament

**Project**: Convert static Ocean Dental landing page to dynamic CMS  
**Stack**: Laravel 11.x, SQLite, Laravel Filament 3.x  
**Environment**: Local Linux Development  

---

## Table of Contents

1. [Prerequisites Check](#1-prerequisites-check)
2. [Phase 1: Backup & Preparation](#phase-1-backup--preparation)
3. [Phase 2: Laravel Installation](#phase-2-laravel-installation)
4. [Phase 3: Laravel Filament Setup](#phase-3-laravel-filament-setup)
5. [Phase 4: Database Design & Models](#phase-4-database-design--models)
6. [Phase 5: Filament Resources](#phase-5-filament-resources)
7. [Phase 6: Frontend Integration](#phase-6-frontend-integration)
8. [Phase 7: Data Seeding](#phase-7-data-seeding)
9. [Phase 8: Testing & Optimization](#phase-8-testing--optimization)
10. [Phase 9: Additional Features](#phase-9-additional-features)

---

## 1. Prerequisites Check

Your current environment:
- ✅ PHP 8.2.29
- ✅ Composer 2.5.8
- ✅ Node.js 18.19.1

### Check SQLite Extension

```bash
php -m | grep sqlite
```

If SQLite is not enabled, install it:

```bash
sudo apt-get update
sudo apt-get install php8.2-sqlite3
```

### Verify Extensions Required by Laravel

```bash
php -m | grep -E 'openssl|pdo|mbstring|tokenizer|xml|ctype|json|bcmath|fileinfo'
```

If any are missing, install them:

```bash
sudo apt-get install php8.2-{openssl,pdo,mbstring,tokenizer,xml,ctype,json,bcmath,fileinfo}
```

---

## Phase 1: Backup & Preparation

### Step 1.1: Create a Backup Branch

```bash
# Check current git status
git status

# Create and switch to a backup branch
git checkout -b static-backup

# Commit current state
git add .
git commit -m "Backup: Static landing page before Laravel migration"

# Switch back to main branch or create a new development branch
git checkout -b laravel-cms
```

### Step 1.2: Document Current Structure

```bash
# List all files in the project
tree -L 2

# Or if tree is not installed:
ls -R
```

### Step 1.3: Create Temporary Backup Directory

```bash
# Create backup directory
mkdir -p ../dental-landing-page-backup

# Copy static files
cp -r index.html events.html event-detail.html style.css script.js images ../dental-landing-page-backup/

echo "✅ Backup created at ../dental-landing-page-backup"
```

---

## Phase 2: Laravel Installation

### Step 2.1: Install Laravel in Current Directory

**Option A: Fresh Installation (Recommended)**

```bash
# Move to parent directory
cd ..

# Create new Laravel project
composer create-project laravel/laravel dental-cms

# Move into the new project
cd dental-cms

# Copy git history if needed
cp -r ../dental-landing-page/.git .

# Copy static files to a temp location
mkdir temp-static
cp -r ../dental-landing-page-backup/* temp-static/
```

**Option B: Install Laravel in Current Directory**

```bash
# CAUTION: This will reorganize your current directory structure
# Make sure you have backups!

# Install Laravel files
composer create-project --prefer-dist laravel/laravel temp-laravel

# Move Laravel files to current directory
mv temp-laravel/* .
mv temp-laravel/.* . 2>/dev/null || true

# Remove temp directory
rm -rf temp-laravel

# Keep static files in a temp folder
mkdir temp-static
mv index.html events.html event-detail.html style.css script.js images temp-static/
```

**For this guide, we'll use Option A (Fresh Installation)**

### Step 2.2: Configure Environment

```bash
# Copy .env.example to .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 2.3: Configure SQLite Database

```bash
# Create database file
touch database/database.sqlite

# Update .env file
cat > .env << 'EOF'
APP_NAME="Ocean Dental CMS"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=Asia/Jakarta
APP_URL=http://localhost:8000

APP_LOCALE=id
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=id_ID

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
# DB_DATABASE will use default database/database.sqlite

BROADCAST_CONNECTION=log
CACHE_STORE=database
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=database
SESSION_LIFETIME=120

MAIL_MAILER=log
EOF

# Regenerate app key
php artisan key:generate
```

### Step 2.4: Run Initial Migration

```bash
# Run default Laravel migrations
php artisan migrate

# Expected output: Migration table created, users table, etc.
```

### Step 2.5: Test Laravel Installation

```bash
# Start Laravel development server
php artisan serve

# In another terminal, test the endpoint
curl http://localhost:8000

# Or open in browser: http://localhost:8000
# You should see the Laravel welcome page

# Press Ctrl+C to stop the server
```

### Step 2.6: Install Node Dependencies

```bash
# Install npm packages
npm install

# Build assets
npm run build
```

---

## Phase 3: Laravel Filament Setup

### Step 3.1: Install Filament

```bash
# Install Filament Panel Builder
composer require filament/filament:"^3.2" -W

# Install Filament
php artisan filament:install --panels
```

When prompted:
- Panel ID: `admin` (press Enter for default)
- Would you like to create a user? `yes`

### Step 3.2: Create Admin User

```bash
# If not created during installation, create manually
php artisan make:filament-user

# Enter:
# Name: Admin
# Email: admin@oceandental.com
# Password: (your secure password)
```

### Step 3.3: Configure Filament

Edit `config/filament.php` (will be created after installation) or use default settings.

### Step 3.4: Test Filament Admin Panel

```bash
# Start server
php artisan serve

# Open browser: http://localhost:8000/admin
# Login with credentials created above
```

You should see the Filament admin dashboard!

### Step 3.5: Customize Filament Branding

Create `app/Providers/Filament/AdminPanelProvider.php` customization:

```bash
# The file should already exist after installation
# We'll customize it later in Phase 5
```

---

## Phase 4: Database Design & Models

### Step 4.1: Design Database Schema

Our CMS will manage:
1. **Events** - Dental camps, seminars, promotions
2. **Services** - Dental treatments and procedures
3. **Testimonials** - Patient reviews
4. **Team Members** - Doctors and staff
5. **Locations** - Clinic branches
6. **Pages** - Dynamic page content (hero, about, etc.)
7. **Settings** - Site-wide configuration
8. **Gallery** - Image gallery

### Step 4.2: Create Models & Migrations

**Create Event Model:**

```bash
php artisan make:model Event -m
```

Edit `database/migrations/YYYY_MM_DD_HHMMSS_create_events_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->string('image')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('location');
            $table->text('address')->nullable();
            $table->string('category')->nullable(); // promo, seminar, workshop, dental-camp
            $table->integer('max_participants')->nullable();
            $table->integer('registered_participants')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->json('benefits')->nullable(); // Array of benefits
            $table->json('requirements')->nullable(); // Array of requirements
            $table->string('registration_url')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->json('meta_tags')->nullable(); // SEO meta tags
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
```

**Create Service Model:**

```bash
php artisan make:model Service -m
```

Edit `database/migrations/YYYY_MM_DD_HHMMSS_create_services_table.php`:

```php
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
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->string('icon')->nullable(); // Font Awesome icon class
            $table->string('image')->nullable();
            $table->string('price_range')->nullable(); // e.g., "Rp 150.000 - Rp 500.000"
            $table->integer('duration')->nullable(); // in minutes
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->json('features')->nullable(); // Array of service features
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
```

**Create Testimonial Model:**

```bash
php artisan make:model Testimonial -m
```

Edit migration:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position')->nullable(); // e.g., "Pasien Reguler"
            $table->text('content');
            $table->integer('rating')->default(5); // 1-5 stars
            $table->string('avatar')->nullable();
            $table->string('service_used')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
```

**Create Team Member Model:**

```bash
php artisan make:model TeamMember -m
```

Edit migration:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position'); // e.g., "Dokter Gigi Umum", "Orthodontist"
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('specialization')->nullable();
            $table->json('qualifications')->nullable(); // Array of degrees/certifications
            $table->integer('years_of_experience')->nullable();
            $table->json('social_links')->nullable(); // Instagram, LinkedIn, etc.
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
```

**Create Location Model:**

```bash
php artisan make:model Location -m
```

Edit migration:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('address');
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->json('opening_hours')->nullable(); // JSON structure for weekly schedule
            $table->text('maps_embed_url')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
```

**Create Page Model (for dynamic content):**

```bash
php artisan make:model Page -m
```

Edit migration:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // e.g., 'hero', 'about', 'contact'
            $table->string('title');
            $table->json('content'); // Flexible JSON structure for different sections
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
```

**Create Gallery Model:**

```bash
php artisan make:model Gallery -m
```

Edit migration:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('category')->nullable(); // clinic, team, events, treatments
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
```

**Create Settings Model:**

```bash
php artisan make:model Setting -m
```

Edit migration:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, textarea, image, boolean, json
            $table->string('group')->default('general'); // general, contact, social, seo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
```

### Step 4.3: Run Migrations

```bash
# Run all migrations
php artisan migrate

# You should see all tables created successfully
```

### Step 4.4: Update Models with Fillable Fields

Edit `app/Models/Event.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'image',
        'start_date',
        'end_date',
        'location',
        'address',
        'category',
        'max_participants',
        'registered_participants',
        'is_active',
        'is_featured',
        'benefits',
        'requirements',
        'registration_url',
        'price',
        'meta_tags',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'benefits' => 'array',
        'requirements' => 'array',
        'meta_tags' => 'array',
        'price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
```

Edit `app/Models/Service.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'icon',
        'image',
        'price_range',
        'duration',
        'order',
        'is_active',
        'is_featured',
        'features',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'features' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });
    }
}
```

Edit `app/Models/Testimonial.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'content',
        'rating',
        'avatar',
        'service_used',
        'is_active',
        'is_featured',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'rating' => 'integer',
    ];
}
```

Edit `app/Models/TeamMember.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'bio',
        'photo',
        'specialization',
        'qualifications',
        'years_of_experience',
        'social_links',
        'order',
        'is_active',
    ];

    protected $casts = [
        'qualifications' => 'array',
        'social_links' => 'array',
        'is_active' => 'boolean',
    ];
}
```

Edit `app/Models/Location.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'address',
        'phone',
        'whatsapp',
        'email',
        'latitude',
        'longitude',
        'opening_hours',
        'maps_embed_url',
        'image',
        'is_active',
        'is_featured',
        'order',
    ];

    protected $casts = [
        'opening_hours' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($location) {
            if (empty($location->slug)) {
                $location->slug = Str::slug($location->name);
            }
        });
    }
}
```

Edit `app/Models/Page.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'content',
        'is_active',
    ];

    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',
    ];
}
```

Edit `app/Models/Gallery.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
```

Edit `app/Models/Setting.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value, $type = 'text', $group = 'general')
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type, 'group' => $group]
        );
    }
}
```

---

## Phase 5: Filament Resources

### Step 5.1: Create Filament Resources

**Create Event Resource:**

```bash
php artisan make:filament-resource Event --generate
```

Edit `app/Filament/Resources/EventResource.php`:

```php
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                        
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        
                        Forms\Components\Select::make('category')
                            ->options([
                                'promo' => 'Promo',
                                'seminar' => 'Seminar',
                                'workshop' => 'Workshop',
                                'dental-camp' => 'Dental Camp',
                            ])
                            ->required(),
                        
                        Forms\Components\Textarea::make('short_description')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Event Details')
                    ->schema([
                        Forms\Components\DateTimePicker::make('start_date')
                            ->required()
                            ->native(false),
                        
                        Forms\Components\DateTimePicker::make('end_date')
                            ->native(false),
                        
                        Forms\Components\TextInput::make('location')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\Textarea::make('address')
                            ->maxLength(500),
                        
                        Forms\Components\TextInput::make('max_participants')
                            ->numeric()
                            ->minValue(1),
                        
                        Forms\Components\TextInput::make('registered_participants')
                            ->numeric()
                            ->default(0),
                        
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->prefix('Rp')
                            ->default(0),
                        
                        Forms\Components\TextInput::make('registration_url')
                            ->url()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\TagsInput::make('benefits')
                            ->placeholder('Add benefit and press Enter'),
                        
                        Forms\Components\TagsInput::make('requirements')
                            ->placeholder('Add requirement and press Enter'),
                    ]),

                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('events')
                            ->imageEditor()
                            ->maxSize(2048),
                    ]),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                        
                        Forms\Components\Toggle::make('is_featured')
                            ->default(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular(),
                
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'promo' => 'success',
                        'seminar' => 'info',
                        'workshop' => 'warning',
                        'dental-camp' => 'danger',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('start_date')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->limit(30),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'promo' => 'Promo',
                        'seminar' => 'Seminar',
                        'workshop' => 'Workshop',
                        'dental-camp' => 'Dental Camp',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active'),
                Tables\Filters\TernaryFilter::make('is_featured'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('start_date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
```

**Create Service Resource:**

```bash
php artisan make:filament-resource Service --generate
```

**Create Other Resources:**

```bash
php artisan make:filament-resource Testimonial --generate
php artisan make:filament-resource TeamMember --generate
php artisan make:filament-resource Location --generate
php artisan make:filament-resource Gallery --generate
php artisan make:filament-resource Page --generate
php artisan make:filament-resource Setting --generate
```

### Step 5.2: Configure Storage for File Uploads

```bash
# Create symbolic link from public/storage to storage/app/public
php artisan storage:link

# Create directories for uploads
mkdir -p storage/app/public/events
mkdir -p storage/app/public/services
mkdir -p storage/app/public/testimonials
mkdir -p storage/app/public/team
mkdir -p storage/app/public/locations
mkdir -p storage/app/public/gallery
```

### Step 5.3: Test Admin Panel

```bash
# Start server
php artisan serve

# Open: http://localhost:8000/admin
# You should see all resources in the sidebar
```

---

## Phase 6: Frontend Integration

### Step 6.1: Copy Static Files to Laravel

```bash
# Copy CSS to public directory
cp temp-static/style.css public/css/style.css

# Copy JS to public directory
mkdir -p public/js
cp temp-static/script.js public/js/script.js

# Copy images
cp -r temp-static/images public/images

# Or if you backed up outside the project:
cp ../dental-landing-page-backup/style.css public/css/
cp ../dental-landing-page-backup/script.js public/js/
cp -r ../dental-landing-page-backup/images public/
```

### Step 6.2: Create Blade Layout

Create `resources/views/layouts/app.blade.php`:

```bash
# Create views directory structure
mkdir -p resources/views/layouts
mkdir -p resources/views/components
mkdir -p resources/views/pages
```

Create the main layout file (you'll need to convert your HTML manually):

```php
{{-- resources/views/layouts/app.blade.php --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <meta name="description" content="@yield('meta_description', setting('site_description'))" />
    <meta name="keywords" content="@yield('meta_keywords', setting('site_keywords'))" />
    <meta name="theme-color" content="#01215E" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    
    <title>@yield('title', config('app.name'))</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    @stack('styles')
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body>
    <!-- Scroll Progress Indicator -->
    <div class="scroll-progress"></div>

    <!-- Navigation -->
    @include('components.navbar')

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    @include('components.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}"></script>
    @stack('scripts')
</body>
</html>
```

### Step 6.3: Create Routes

Edit `routes/web.php`:

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');
```

### Step 6.4: Create Controllers

```bash
php artisan make:controller HomeController
php artisan make:controller EventController
```

Edit `app/Http/Controllers/HomeController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Location;
use App\Models\Gallery;
use App\Models\Page;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'hero' => Page::where('key', 'hero')->first(),
            'about' => Page::where('key', 'about')->first(),
            'services' => Service::where('is_active', true)
                ->orderBy('order')
                ->get(),
            'featuredEvents' => Event::where('is_active', true)
                ->where('is_featured', true)
                ->where('start_date', '>=', now())
                ->orderBy('start_date')
                ->take(3)
                ->get(),
            'testimonials' => Testimonial::where('is_active', true)
                ->orderBy('order')
                ->take(6)
                ->get(),
            'team' => TeamMember::where('is_active', true)
                ->orderBy('order')
                ->get(),
            'locations' => Location::where('is_active', true)
                ->orderBy('order')
                ->get(),
            'gallery' => Gallery::where('is_active', true)
                ->orderBy('order')
                ->take(8)
                ->get(),
        ];

        return view('pages.home', $data);
    }
}
```

Edit `app/Http/Controllers/EventController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::where('is_active', true)
            ->where('start_date', '>=', now())
            ->orderBy('start_date');

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $events = $query->paginate(12);

        return view('pages.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        if (!$event->is_active) {
            abort(404);
        }

        $relatedEvents = Event::where('is_active', true)
            ->where('id', '!=', $event->id)
            ->where('category', $event->category)
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->take(3)
            ->get();

        return view('pages.events.show', compact('event', 'relatedEvents'));
    }
}
```

### Step 6.5: Create Views

You'll need to manually convert your HTML files to Blade templates. This involves:

1. Breaking down `index.html` into sections
2. Creating components for reusable parts (navbar, footer, cards)
3. Replacing static content with dynamic data using Blade syntax

Example for creating the home page:

```bash
# Create the view file
touch resources/views/pages/home.blade.php
```

Then manually convert the HTML to Blade (see Phase 7 for examples with actual data).

---

## Phase 7: Data Seeding

### Step 7.1: Create Seeders

```bash
php artisan make:seeder EventSeeder
php artisan make:seeder ServiceSeeder
php artisan make:seeder TestimonialSeeder
php artisan make:seeder TeamMemberSeeder
php artisan make:seeder LocationSeeder
php artisan make:seeder PageSeeder
php artisan make:seeder SettingSeeder
```

### Step 7.2: Populate Seeders with Existing Data

Edit `database/seeders/EventSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'Free Dental Check-up Camp',
                'slug' => 'free-dental-check-up-camp',
                'description' => '<p>Pemeriksaan gigi gratis untuk 100 peserta pertama! Dapatkan konsultasi langsung dengan dokter gigi profesional kami dan screening kesehatan mulut lengkap.</p>',
                'short_description' => 'Pemeriksaan gigi gratis untuk 100 peserta pertama.',
                'image' => null, // Add image path after uploading
                'start_date' => '2024-03-15 09:00:00',
                'end_date' => '2024-03-15 16:00:00',
                'location' => 'Ocean Dental Kelapa Gading',
                'address' => 'Jl. Boulevard Raya, Jakarta Utara',
                'category' => 'dental-camp',
                'max_participants' => 100,
                'registered_participants' => 0,
                'is_active' => true,
                'is_featured' => true,
                'benefits' => [
                    'Pemeriksaan gigi gratis',
                    'Konsultasi dokter',
                    'Screening kesehatan mulut',
                    'Goodie bag eksklusif',
                ],
                'requirements' => [
                    'Daftar online terlebih dahulu',
                    'Bawa KTP/identitas',
                    'Datang tepat waktu',
                ],
                'registration_url' => '#',
                'price' => 0,
            ],
            // Add more events from your static HTML
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
```

Edit `database/seeders/ServiceSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Pemeriksaan Rutin',
                'slug' => 'pemeriksaan-rutin',
                'description' => '<p>Pemeriksaan gigi rutin setiap 6 bulan untuk menjaga kesehatan gigi dan mulut Anda.</p>',
                'short_description' => 'Check-up kesehatan gigi lengkap',
                'icon' => 'fa-tooth',
                'price_range' => 'Rp 150.000 - Rp 300.000',
                'duration' => 30,
                'order' => 1,
                'is_active' => true,
                'is_featured' => true,
                'features' => [
                    'Pemeriksaan menyeluruh',
                    'Konsultasi dokter',
                    'Laporan kesehatan',
                ],
            ],
            [
                'name' => 'Scaling & Pembersihan',
                'slug' => 'scaling-pembersihan',
                'description' => '<p>Pembersihan karang gigi dan plak untuk menjaga kesehatan gusi.</p>',
                'short_description' => 'Bersihkan karang gigi dan plak',
                'icon' => 'fa-spray-can',
                'price_range' => 'Rp 250.000 - Rp 500.000',
                'duration' => 45,
                'order' => 2,
                'is_active' => true,
                'is_featured' => true,
                'features' => [
                    'Pembersihan karang gigi',
                    'Polishing',
                    'Fluoride treatment',
                ],
            ],
            // Add more services
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
```

### Step 7.3: Update DatabaseSeeder

Edit `database/seeders/DatabaseSeeder.php`:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            EventSeeder::class,
            ServiceSeeder::class,
            TestimonialSeeder::class,
            TeamMemberSeeder::class,
            LocationSeeder::class,
            PageSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
```

### Step 7.4: Run Seeders

```bash
# Run all seeders
php artisan db:seed

# Or run specific seeder
php artisan db:seed --class=EventSeeder
```

### Step 7.5: Verify Data

```bash
# Start server
php artisan serve

# Open admin panel: http://localhost:8000/admin
# Check if all data is populated
```

---

## Phase 8: Testing & Optimization

### Step 8.1: Test CRUD Operations

1. Login to admin panel
2. Create a new event
3. Edit an existing service
4. Upload images
5. Toggle active status
6. Delete test entries

### Step 8.2: Test Frontend

```bash
# Visit homepage
curl http://localhost:8000

# Or open in browser and verify:
# - All sections are loading
# - Dynamic data is displayed
# - Images are working
# - Links are functional
```

### Step 8.3: Setup Caching

Edit `.env`:

```env
CACHE_STORE=database
```

Run cache migration:

```bash
php artisan cache:table
php artisan migrate
```

### Step 8.4: Optimize Laravel

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Clear all caches (use during development)
php artisan optimize:clear
```

### Step 8.5: Setup Queue for Better Performance

```bash
# Create jobs table
php artisan queue:table
php artisan migrate

# Run queue worker (in development)
php artisan queue:work
```

---

## Phase 9: Additional Features

### Step 9.1: Create Helper Functions

Create `app/Helpers/helpers.php`:

```php
<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return Setting::get($key, $default);
    }
}
```

Register helper in `composer.json`:

```json
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Database\\Factories\\": "database/factories/",
        "Database\\Seeders\\": "database/seeders/"
    },
    "files": [
        "app/Helpers/helpers.php"
    ]
},
```

Run:

```bash
composer dump-autoload
```

### Step 9.2: Add Search Functionality

Install Laravel Scout:

```bash
composer require laravel/scout
php artisan vendor:publish --provider="Laravel\Scout\ScoutServiceProvider"
```

Add to Event model:

```php
use Laravel\Scout\Searchable;

class Event extends Model
{
    use Searchable;
    
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
        ];
    }
}
```

### Step 9.3: Add Image Optimization

Install Spatie Image package:

```bash
composer require spatie/laravel-image-optimizer
php artisan vendor:publish --provider="Spatie\LaravelImageOptimizer\ImageOptimizerServiceProvider"
```

### Step 9.4: Add SEO Features

Install Spatie Laravel SEO:

```bash
composer require spatie/laravel-sitemap
```

Create sitemap generator:

```bash
php artisan make:command GenerateSitemap
```

### Step 9.5: Add Analytics Dashboard (Optional)

Add to Filament dashboard:

```bash
composer require filament/widgets
```

---

## Phase 10: Final Checklist

### Before Going Live:

- [ ] All static content migrated to database
- [ ] All images uploaded and optimized
- [ ] All routes tested
- [ ] Admin panel tested
- [ ] Forms working correctly
- [ ] SEO meta tags implemented
- [ ] Performance optimized
- [ ] Backups configured
- [ ] Error handling implemented
- [ ] Security headers configured

### Production Commands:

```bash
# Set environment to production
APP_ENV=production
APP_DEBUG=false

# Optimize everything
php artisan optimize

# Set proper permissions
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## Useful Commands Reference

### Development:

```bash
# Start server
php artisan serve

# Clear cache
php artisan optimize:clear

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Create new admin user
php artisan make:filament-user
```

### Debugging:

```bash
# Tail logs
tail -f storage/logs/laravel.log

# Tinker (Laravel REPL)
php artisan tinker

# List all routes
php artisan route:list

# Database info
php artisan db:show
```

### Git Workflow:

```bash
# Commit progress
git add .
git commit -m "feat: implement Laravel CMS with Filament"

# Push to remote
git push origin laravel-cms
```

---

## Troubleshooting

### Issue: Permission Denied on storage/

```bash
sudo chmod -R 775 storage
sudo chown -R $USER:www-data storage
```

### Issue: SQLite database not found

```bash
touch database/database.sqlite
php artisan migrate:fresh
```

### Issue: Symbolic link not working

```bash
rm public/storage
php artisan storage:link
```

### Issue: Composer memory limit

```bash
COMPOSER_MEMORY_LIMIT=-1 composer install
```

---

## Next Steps

After completing this guide:

1. **Customize Filament theme** to match Ocean Dental branding
2. **Add more advanced features**:
   - Online appointment booking
   - Email notifications
   - WhatsApp integration
   - Multi-language support
3. **Implement automated backups**
4. **Setup CI/CD pipeline**
5. **Configure production server**

---

## Support & Resources

- Laravel Documentation: https://laravel.com/docs
- Filament Documentation: https://filamentphp.com/docs
- Laravel Community: https://laracasts.com
- Stack Overflow: Tag `laravel` and `filament`

---

**Created**: 2024  
**Version**: 1.0  
**Author**: Ocean Dental Development Team
