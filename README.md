# REST API Lumen framework

---

## Для того чтобы начать:

### Установка зависимостей
```
composer install
```

### Установка ключей приложения и JWT
```
php artisan key:generate
php artisan jwt:secret
```

### Выполнение миграций и сидеров
```
php artisan migrate --seed
```

### Запуск локального сервера
```
php artisan serve
```
**По умолчанию:** http://localhost:9090

### Дополнительно
#### Tlint для проверки стиля кода, запускает через команду `vendor/bin/tlint`
```
composer tlint
```

### Тестирование
#### Тестирование выполняется через **PHPUnit**
```
composer test
```

### API роуты
| HTTP метод | Роут           | Действие | Описание                         |
|------------|----------------|----------|----------------------------------|
| POST       | api/login      | login    | Авторизация пользователя         |
| GET        | api/loans      | index    | Получает все займы               |
| POST       | api/loans      | store    | Создает новый займ               |
| GET        | api/loans/{id} | show     | Получает займ по id              |
| PUT        | api/loans/{id} | update   | Обновляет информацию займа по id |
| DELETE     | api/loans/{id} | delete   | Удаляет займ по id               |



