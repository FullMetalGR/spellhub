# 🧙‍♂️ SpellHub - A Magical Spell Management System

[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com)
[![Filament](https://img.shields.io/badge/Filament-3.x-blue.svg)](https://filamentphp.com)
[![Blueprint](https://img.shields.io/badge/Blueprint-Rapid_Dev-green.svg)](https://blueprint.laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-purple.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)](https://mysql.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC.svg)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-4.x-646CFF.svg)](https://vitejs.dev)
[![Gemini AI](https://img.shields.io/badge/Gemini_AI-Google-yellow.svg)](https://ai.google.dev/gemini)

> **🌐 Live Demo:** [https://spellhub.hbqy8ukzct-xlm41vj054dy.p.temp-site.link/](https://spellhub.hbqy8ukzct-xlm41vj054dy.p.temp-site.link/)

## 📖 What is SpellHub?

SpellHub is part a spellbook library and part a spell management system that allows users to create, discover, and collect various spells from every fantasy universe. Think of it as a "GitHub for spells" - a collaborative platform where fantasy enthusiasts can share their vast magical knowledge and collect legendary spells.

The webapp features a public homepage where users can browse and copy spells, while providing a logged-in user panel for spell creation and collecting.

## 🎯 Why Was SpellHub Created?

SpellHub was born from the idea that magical knowledge should be accessible and shareable. In many fantasy worlds, spells are often kept secret or scattered across ancient tomes. This project aims to:

- **Democratize Magic**: Make spell knowledge accessible to all
- **Foster Collaboration**: Allow users to share and improve spells
- **Preserve Lore**: Document spells from various fantasy universes
- **Showcase Modern Web Development**: Demonstrate cutting-edge Laravel and Filament capabilities
- **Create Community**: Build a platform for fantasy enthusiasts

## ✨ What Does SpellHub Showcase?

### 🏠 **Public Homepage**
On the homepage a collection of spells from various fantasy universes is showcased. Users can:
- Browse spells with advanced filtering (school, rarity, level)
- Copy spells to their personal collection
- Sneak a peak on various spell cards

Disclosure: The homepage layout was partly vibe-coded, because I wanted to focus more on the backend functionalities.

### 🎮 **Interactive Features**
- **Spell Copying**: One-click spell collection
- **Real-time Notifications**: AJAX-powered feedback
- **Advanced Filtering**: Search by magic school, rarity, level, and name
- **Pagination**: To prevent eternal scrolling

### 🛡️ **Admin Panel**
A base Filament-based admin interface that provides:
- **Spell Management**: Create, edit, and delete spells
- **User Authentication**: Login with a user (wizard!) account
- **AI Integration**: Automatic rarity determination using Gemini AI
- **Dashboard**: An overview of the world of magic

## 🛠️ Technologies & Features Used

### **Backend Framework**
- **Laravel 10.x** - Powers the entire application with routing, controllers, and middleware
- **Blueprint** - Used to rapidly generate models, migrations, and Filament resources
- **Eloquent ORM** - Manages all database relationships between users, spells, and spell collections

### **Admin Panel**
- **Filament 3.x** - Provides the complete admin interface for spell management and user authentication
- **Livewire** - Enables real-time spell creation forms and dynamic table updates
- **Custom Resources** - Tailored spell management forms with AI integration and validation
- **Form Validation** - Ensures spell data integrity and prevents duplicate spell names per user
- **Table Filters** - Allows filtering spells by school, rarity, level, and creator in the admin panel

### **Database & Data Management**
- **MySQL 8.0+** - Stores all spell data, user accounts, and spell-user relationships
- **Database Migrations** - Manages the spells table with enum fields and the spell_user pivot table
- **Seeders** - Populates the database with 50 spells from various fantasy universes and 10 wizard users

### **Frontend**
- **Tailwind CSS 3.x** - Styles the public homepage with responsive spell cards and rarity badges
- **Vite** - Builds and optimizes the frontend assets for the public spell browsing interface

### **AI Integration**
- **Google Gemini AI** - Automatically determines spell rarity when users create new spells

### **Security & Authentication**
- **Laravel Sanctum** - Handles user authentication for the admin panel and spell copying functionality
- **CSRF Protection** - Protects all forms including spell creation and copying from cross-site attacks

### **Development Tools**
- **Laragon** - Provided the local development environment with Apache, MySQL, and PHP
- **Cmder** - Used for running Artisan commands and managing the development workflow
- **HeidiDB** - Managed the MySQL database during development and testing
- **PHPStorm** - Primary IDE for writing all Laravel code, models, and Filament resources
- **Composer** - Installed Laravel, Filament, and all PHP dependencies
- **NPM** - Installed Tailwind CSS, Vite, and frontend build tools
- **Git** - Version controlled the entire project from initial setup to deployment
- **Artisan Commands** - Created custom commands for AI testing and database cleanup

## 🌟 Key Features

The core functionality of SpellHub revolves around spell management. Users can create spells, defining them with a name and adding a detailed descriptions. They can categorize them by magic schools inspired by D&D. Each spell can be assigned different levels ranging from Cantrip to Divine, and users can specify the required components.

The standout feature of the webapp is the AI-powered spell rarity determination. When users create new spells, the system automatically analyzes the spell's characteristics using Google Gemini AI to determine whether it should be classified as Common, Uncommon, Rare, Epic, or Legendary. This intelligent definition of rarity adds depth to the spell collection aspect for those who hunt the most unique of spells.

## 🚀 Upcoming Features (Work in Progress)

Here are some more of the features that I plan on developing:
- **New Models** - Models for SpellLevel, MaterialComponents & SpellSchool
- **Spell Ratings & Reviews** - Community feedback system
- **User Profiles** - Detailed wizard profiles
- **API Integration** - RESTful API for developers
- **Advanced Search** - Full-text search capabilities
- **Spell Templates** - Reusable spell structures
- **Advanced AI** - Spell generation and optimization
- **PHPUnit Testing** - Comprehensive test coverage

## 🛠️ Local Installation

### **Prerequisites**
- PHP 8.1 or higher
- Composer
- Node.js 16+ and NPM
- MySQL 8.0 or higher
- Git
- Laragon (recommended for local development)

### **Quick Start (Recommended)**
Since setting up the database and all dependencies can be time-consuming, we recommend trying the **live demo** first:

🌐 **Live Demo:** [https://spellhub.hbqy8ukzct-xlm41vj054dy.p.temp-site.link/](https://spellhub.hbqy8ukzct-xlm41vj054dy.p.temp-site.link/)

### **Full Local Installation**

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/spellhub.git
   cd spellhub
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js Dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure Database**
   Edit `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=spellhub
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Set up Gemini AI (Optional)**
   Add your Gemini API key to `.env`:
   ```env
   GEMINI_API_KEY=your_gemini_api_key_here
   ```

7. **Run Migrations and Seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```

8. **Build Frontend Assets**
   ```bash
   npm run build
   ```

9. **Start Development Server**
   ```bash
   php artisan serve
   ```

10. **Access the Application**
    - **Public Site**: http://localhost:8000
    - **Admin Panel**: http://localhost:8000/admin

### **Default Login Credentials**
After seeding, you can log in with any of these accounts:
- **Gandalf**: gandalf@middle-earth.com / 1234567890
- **Merlin**: merlin@avalon.com / 1234567890
- **Yennefer**: yennefer@vengerberg.com / 1234567890

## 📁 Project Structure

```
spellhub/
├── app/
│   ├── Console/Commands/     # Custom Artisan commands
│   ├── Enums/               # PHP 8.1 Enums for spell attributes
│   ├── Filament/            # Admin panel resources
│   ├── Http/Controllers/    # Web controllers
│   ├── Models/              # Eloquent models
│   └── Services/            # AI and business logic services
├── database/
│   ├── migrations/          # Database schema
│   └── seeders/             # Data population
├── resources/
│   ├── views/               # Blade templates
│   ├── css/                 # Tailwind CSS
│   └── js/                  # JavaScript files
├── routes/                  # Application routes
└── config/                  # Configuration files
```

## 🤝 Contributing

We welcome contributions from the magical community! Here's how you can help:

1. **Fork the repository**
2. **Create a feature branch** (`git checkout -b feature/amazing-spell`)
3. **Commit your changes** (`git commit -m 'Add amazing spell'`)
4. **Push to the branch** (`git push origin feature/amazing-spell`)
5. **Open a Pull Request**

### **Contribution Guidelines**
- Follow Laravel coding standards
- Add tests for new features
- Update documentation as needed
- Be respectful and inclusive

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- **Laravel Team** - For the amazing framework
- **Filament Team** - For the incredible admin panel
- **Blueprint Team** - For rapid development capabilities
- **Google AI Team** - For Gemini AI integration
- **Fantasy Authors** - For inspiring the magical content
- **Open Source Community** - For all the amazing tools and libraries

## 🌟 Star History

If you find this project useful, please consider giving it a ⭐️ on GitHub!

---

**Made with ❤️ and 🧙‍♂️ by the FullMetalGR**

*"Magic is not about power, it's about knowledge and community."*
