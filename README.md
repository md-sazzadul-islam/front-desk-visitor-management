# Welcome - Frontdesk/visitor Management System

A front desk / visitor management system is an essential aspect of any business. It serves as the first point of contact for customers, potentially making or breaking their experience. This system is designed to handle all customer inquiries and requests, track them effectively, and automate parts of the process. It also provides information about the company’s services and products, saving time and money while enhancing customer service.

![Welcome - Frontdesk/visitor Management System](https://cnd.sazzadul.com/welcome_1.jpg)

## Features

- Welcome visitor records
- Capture visitor images
- Connect and sync with Active Directory (AD)
- Web-based front desk for visitor check-in/out
- Front desk dashboard with visitor analytics
- Daily front desk visitor list
- List of visitors not checked out
- Unlimited accounts
- User role and permission system
- Responsive interface for desktop, tablet, and mobile
- Cloud and self-hosted solutions

![Capture Visitor Image](https://cnd.sazzadul.com/Photography.jpg)
![Connect with Active Directory](https://cnd.sazzadul.com/ad.jpg)
![Technologies](https://cnd.sazzadul.com/Technologies.jpg)

## Requirements

- **PHP version ^8.1**
- MySQL 5.x or higher
- Nginx or Apache
- **LDAP Extension** (if using Active Directory)

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/md-sazzadul-islam/front-desk-visitor-management.git
    cd front-desk-visitor-management
    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Copy the example environment file and configure the application:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Configure the `.env` file with your database and other settings.

5. Import SQL:
    ```bash
    File: sql/welcome.sql 
    ```

6. Serve the application:
    ```bash
    php artisan serve
    ```

## Configuration

### LDAP Configuration

Ensure your `.env` file contains the following LDAP configurations:

```env
LDAP_HOSTS=mail.example.com
LDAP_PORT=389
LDAP_USERNAME=welcome@example.com
LDAP_PASSWORD=password
LDAP_BASE_DN="dc=example,dc=com"
```

### Mail Configuration

Configure your mail settings in the `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=f0958845bdc3a0
MAIL_PASSWORD=0256d421515e5d
MAIL_ENCRYPTION=tls
```

## Demo Login

Use the following demo accounts to log in:

### Admin
- **Username:** [admin@sazzadul.com](mailto:admin@sazzadul.com)
- **Password:** 12345678

### User
- **Username:** [user@sazzadul.com](mailto:user@sazzadul.com)
- **Password:** 12345678

## Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are greatly appreciated.

## Contact

Md Sazzadul Islam - [https://sazzadul.com](https://sazzadul.com)

Project Link: [https://github.com/md-sazzadul-islam/front-desk-visitor-management](https://github.com/md-sazzadul-islam/front-desk-visitor-management)

---

For more details, visit the [project documentation](https://github.com/md-sazzadul-islam/front-desk-visitor-management/wiki).