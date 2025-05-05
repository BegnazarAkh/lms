# LMS Home Assignment

**Name:** `Begnazar Akhmadjonov`

**Neptun ID:** `CW363Z`

---

This solution was submitted and prepared by the student named above for the home assignment of the Web Engineering course.  
I declare that this solution is my own work.  
I have not copied or used third party solutions.  
I have not passed my solution to my classmates, nor made it public.  

Students’ regulation of Eötvös Loránd University (ELTE Regulations Vol. II. 74/C. §) states that as long as a student presents another student’s work—or at least a significant part of it—as his/her own performance, it will count as a disciplinary fault. The most serious consequence of a disciplinary fault can be dismissal of the student from the University.

---

## Pre-defined Teacher Accounts

Use the following credentials to sign in as a teacher:

- **Alice Teacher**: alice.teacher@example.com / password123  
- **Bob Teacher**: bob.teacher@example.com / secure456

---

## Pre-defined Student Accounts

Use the following credentials to sign in as a student:

- **Sara Student**: sara.student@example.com / studypass
- **Mike Student**: mike.student@example.com / mikepass


## Getting Started

### Clone the Repository

```bash
git clone https://github.com/BegnazarAkh/lms.git
cd lms-main

```

### Install Dependencies

```bash
composer install
```
# Copy environment file and generate app key

```bash
cp .env.example .env
php artisan key:generate
```

# Set up the database (using SQLite)

```bash
touch database/database.sqlite
php artisan migrate:fresh --seed
```

# Compile assets

```bash
npm install && npm run dev
```

# Run the application

```bash
php artisan serve
```
