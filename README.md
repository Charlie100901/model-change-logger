# Model Change Logger
**Laravel library for recording changes (update and delete) in models.**  
Records modified fields, their previous value, new value, the responsible user, and the date of the change in a database table.

---

## 📦 Installation

Add the package to your project via Composer:
```bash
composer require carlosdev/model-change-logger
```

Make sure you have PHP 8.0+ and Laravel 10.

## 🔧 Configuration

Publish and run migrations:
```bash
php artisan migrate
```

Use the trait in the model you want to audit:
```php
use CarlosDev\ModelChangeLogger\Traits\TracksChanges;

class JobOffer extends Model
{
    use TracksChanges;
}
```

(Optional) Audit only specific fields:
If you want to record only certain fields, define the $auditFields property in your model:
```php
protected array $auditFields = ['job_offer_status_id', 'title'];
```

## 🧠 What does it record?

- Changes to individual fields when performing update().
- Deletions (delete and forceDelete), saving the event but without specific fields.
- Responsible user (Auth::id()).
- Affected model and ID.
- Date and time of the change.

## 📄 Structure of the model_changes table

| Field | Description |
|-------|-------------|
| model_type | Class of the affected model (App\Models\X) |
| model_id | ID of the modified model |
| field | Field that changed |
| old_value | Previous value of the field |
| new_value | New value of the field |
| user_id | ID of the user who made the change |
| event | Type of event (updated, deleted, etc.) |
| changed_at | Date and time of the change |


## ✅ Compatibility

- PHP: >= 8.0
- Laravel: ^10.0

## 📬 Contributions

Suggestions, improvements, and pull requests are welcome! 🚀

This package is designed for projects that require change traceability without depending on complex auditing packages.

## 📄 License

MIT © CarlosDev