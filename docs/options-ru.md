API
===
Опции хранятся в таблице `admin_options` в виде ключ - значение. Значение опции в таблице хранится в виде JSON.
Для работы с опциями можно использовать как хелпер `option()` так и фасад `Skoro\AdminPack\Facades\Option`.

### option()
- `option()` возвращается модель опций `Skoro\AdminPack\Models\Option`.
- `option($key, $default)` получить значение опции `$key`, если опция не найдена, то вернуть `$default`.
- `option(['key' => 'value'])` изменить или создать опцию, если `$key` не найден, то новая опция будет создана.

### Фасад `Skoro\AdminPack\Facades\Option`
- `exists(string $key): bool` проверка существования опции.
- `get(string $key, $default = null)` получить значение опции и, если опция не найдена, то вернуть `$default`.
- `set($key, $value = null)` обновить или создать новую опцию, если `$key` массив, то можно обновить или создать сразу несколько опций, например:
```
Option::set(['opt1' => 'value1', 'opt2' => 'value2']);
```
- `remove(string $key)` удалить опцию.

Стандартные опции
=================
|Опция|Значение по-умолчанию|Описание|
|-----|---------------------|--------|
|user_register_enable|(bool) true|Регистрация пользователей включена. В противном случае пользователя можно создать только вручную.|
|user_default_role|(int) 1|ID роли, которая назначается пользователю при регистрации.|
|user_password_min|(int) 6|Минимальная длина пароля при регистрации или создании пользователя.|

Страница опций
==============
Для пользователя с правами `system: manage options` доступная страница опций.
Эта страница создается динамически в зависимости от наявных опций.
Чтобы опция была доступна на этой странице должна быть соответствующая запись в таблице `option_elements`.
Все элементы группируются во вкладки, см. поле `group` ниже.

Поля `option_elements`:
| Поле       | Описание |
|------------|----------|
|option_id   |ID опции из таблицы `options` для которой создается элемент.|
|perm_id     |ID права доступа из таблицы `permissions` (пока не используется).|
|label       |Заголовок элемента.|
|description |Описание элемента.|
|group       |Название вкладки в которой будет расположен элемент.|
|values      |Ограничить выбор только указанными значениями, используется для виджета select, хранится в виде JSON.|
|validators  |[Валидаторы](https://laravel.com/docs/7.x/validation#available-validation-rules)|
|widget      |Виджет элемента: checkbox, input, select.|
|priority    |Приоритет, чем меньше, тем выше будет расположен элемент.|

Пример добавления элементов находится в файле `/src/Seeders/OptionElementSeeder.php`.

Управление опциями из командной строки
======================================

```
artisan option:list
```
Показывает все доступные опции и их значения.

```
artisan option:get option
```
Показывает значение опции `option`.

```
artisan option:set option key
```
Устанавливает новое значение для `option`. При помощи этой команды можно установить только простое значение опции, список, массив установить нельзя. Если в качестве `value` строка true/false то она преобразовывается в соответствующее значение boolean.

```
artisan option:delete option
```
Удалить опцию `option`.
