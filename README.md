# Future Behavior Analysis (FBA) LMS

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![AWS](https://img.shields.io/badge/AWS-S3_%26_CloudFront-232F3E?style=flat-square&logo=amazonwebservices&logoColor=white)](https://aws.amazon.com/)
[![Stripe](https://img.shields.io/badge/Stripe-Cashier-635BFF?style=flat-square&logo=stripe&logoColor=white)](https://stripe.com)

---
<div style="margin-top: 16px; display: flex; justify-content: center; align-items: center; gap: 8px">
    <b style="font-size: 18px; text-align: center;"> Platform Link :</b> 
    <span> 
        <a href="https://futuresbehavioranalysis.com" style="font-size: 16px;">Future Behavior Analysis (Web)</a>
    </span> 
</div>

---

### ◼ About the Project

A specialized e-learning and Learning Management System (LMS) designed for Applied Behavior Analysis (ABA) training. The platform empowers neurodivergent children, families, educators, and therapists through structured video courses, modular curriculum tracking, interactive quizzes, automated certificate generation, dynamic content management, and recurring subscription billing.

---

### ◼ My Role

Responsible for developing the complete backend architecture, RESTful API endpoints for the React frontend, and building the administrative CMS dashboard from scratch.

---

### ◼ Tech Stack

| Category | Technology |
| :--- | :--- |
| **Backend** | Laravel 12, PHP 8.2+ |
| **Admin Dashboard** | Blade, Tailwind CSS v4, Preline UI, Alpine.js, Vite |
| **Frontend (Association)** | React Web App |
| **Architecture** | Layered MVC with Feature-Segmented Routing & Helper Architecture |
| **Design Pattern** | Service & Helper Pattern / Form Request Validation |
| **Database** | MySQL, Eloquent ORM |
| **Cloud & Media** | AWS S3, CloudFront CDN, `league/flysystem-aws-s3-v3` |
| **Video Processing** | `getID3` Audio/Video Metadata Analyzer, Chunked Upload Engine |
| **Auth & Security** | `Sanctum` (RESTful API Tokens), `Breeze` (Admin Web Sessions), CORS |
| **Billing & Subscriptions** | `Laravel Cashier` (Stripe Checkout Sessions, Tiers & Webhooks) |
| **Progress & Tracking** | Granular Lesson Tracker, Quiz Evaluation, Gamification Engine |
| **File Handling** | Chunked Video & File Upload Handler, Asset Management |
| **Queues & Storage** | Laravel Database Queues, Scheduler, Public & S3 Disks |


<div style="margin:48px auto;  background-color: #fff8e1; border: 1px solid #ffe082; border-left: 5px solid #ffb300; padding: 14px 18px; border-radius: 8px; color: #5d4037;">
  <strong>⚠️ Note on Confidentiality</strong><br>
  Due to proprietary restrictions, sensitive credentials have been replaced with fake/personal test data, and files containing proprietary business architecture was removed. Modules, sub-modules, and the underlying structure have been retained for inspection & review.
</div>


### ◼ CORE MODULES

`🔴 LMS & Courses` `🔵 Quizzes & Assessments` `🟡 Progress & Gamification` `🟢 Subscriptions & Billing` `🟣 Admin CMS`

---

### ◼ FEATURES

- **Course LMS:** Multi-modular course management system with lessons, resources, and instructor assignments.
- **Chunked Video Uploads:** Resumable chunk uploader for course videos with automatic duration calculation via getID3.
- **Quizzes & Assessments:** Dynamic quiz builder with multiple-choice questions, answer logs, and instant grading.
- **Progress Tracking:** Lesson completion logs, watch time tracking, and course progress bars.
- **Achievements:** User milestone boards with point balances, unlockable badges, and streak tracking.
- **Certificates:** Automated PDF certificate generation upon course and quiz completion.
- **Billing & Subscriptions:** Stripe checkouts and tiered subscription plans via Laravel Cashier.
- **Admin CMS:** Dynamic controls for homepage sections, FAQs, policies, and contact form messages.
- **Auth & Roles:** Role-based access (Super Admin, Admin, Student) with dual web/API auth and profile editing.
- **DataTables:** Server-side paginated tables with real-time search, sorting, and bulk actions.

---

### ◼ History

Originally architected on Laravel 12 with Laravel Breeze and Sanctum, the platform was developed to support a comprehensive Applied Behavior Analysis curriculum. As curriculum demands expanded to include over 40 hours of HD video training, the backend was enhanced with a custom chunked uploader, `getID3` metadata extraction, AWS S3/CloudFront CDN pipelines, an automated certification engine, and seamless Stripe subscription billing.

---

### ◼ Impact of this project

- Empowered a US-based BCBA specialist and Applied Behavior Analysis practice with a dedicated e-learning platform.
- Engineered an optimized media pipeline to host and stream ~40 hours of high-definition training content via AWS S3 & CloudFront.
- Implemented automated subscription tiers and paywalls driving recurring student enrollments via Stripe.
- Delivered comprehensive progress tracking, gamified badges, and automated certificate generation to enhance student completion rates.

---

### ◼ Architecture Highlights

```text
app/
├── Console/Commands/         # Scheduled and custom CLI commands
├── Helpers/                  # Reusable domain & utility helpers
│   ├── CourseHelpers/        # Course statistics, badge helpers, time counting
│   ├── PaymentHelpers/       # Subscription auth checks and transaction helpers
│   ├── Ui/                   # Server-side DataTables helpers, dynamic timezone converters
│   ├── ApiJsonReturnHelper.php
│   ├── CertificateGenerate.php
│   ├── ExceptionHandling.php
│   ├── FileManagement.php    # Chunk upload and file storage management
│   └── GamificationHelper.php
├── Http/
│   ├── Controllers/
│   │   ├── Admin/            # Admin CMS controllers (courses, modules, quizzes, users)
│   │   ├── Api/              # RESTful API controllers (Sanctum-authenticated student endpoints)
│   │   ├── Profiles/         # Profile management (Web & API)
│   │   └── Subscription/     # Stripe Cashier, checkout sessions & webhooks
│   └── Requests/             # Form request validations (Auth, Profiles, Courses)
├── Models/
│   ├── Certificates/         # CertificateFinal, CertificateMeta
│   ├── Courses/              # Course, CourseModule, CourseLesson, CourseInstructor
│   ├── Quizzes/              # Quiz, QuizQuestion, QuizOption, QuizAnswers
│   ├── Subscription/         # SubscribedUser, SubscriptionTier, SubscriptionKeys
│   ├── Trackers/             # ProgressLesson, ProgressQuiz, ProgressCourse, Gamification
│   └── Webpages/             # Homepage, AboutUs, ContactUs, CommonSection
├── Notifications/            # Email and database notification channels
├── Providers/                # App & Stripe service providers
└── View/Components/          # Blade dashboard and UI components

routes/
├── Admin/                    # Admin dashboard routes & CMS page routes
├── Courses/                  # Course, module, lesson, and quiz routes (Web & API)
├── Frontend/                 # Public web pages & API auth routes
├── Profiles/                 # Profile management routes
├── Progress/                 # Student progress tracking & gamification routes
├── Subscriptions/            # Subscription tiers, checkout & Stripe webhook routes
├── Students/                 # Enrolled student and learner routes
├── api.php                   # Base API registry
└── web.php                   # Base web & Breeze authentication routes
```

---

### ◼ Setup

```bash
# 1. Install dependencies
composer install
npm install
npm run build

# 2. Environment & key
cp .env.example .env
php artisan key:generate

# 3. Database & storage
php artisan migrate --seed
php artisan storage:link

# 4. Run
composer run dev
php artisan queue:work
```

---

### ◼ License

Proprietary. All rights reserved.
