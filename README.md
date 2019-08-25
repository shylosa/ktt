<h1>Развернутый Opencart</h1>
<li>Докеризован.</li>
<li>Сервер: Apache</li><br>

<strong>Универсальный рецепт для Опенкарт:</strong>
<ol>
    <li>Подготавливаем docker-compose.yml файл с Opencart, PHP-FPM, MySQL, PHPMyAdmin.</li>
    <li>Создаём папку public.
    <li>Копируем туда распакованный Opencart.
    <li>Устанавливаем права для этой папки:<br>
     sudo chmod -R 775 public.</li>
    <li>Запускаем команду:<br> 
    docker-compose up --build -d.</li>
    <li>Заходим на адрес localhost:86 и проводим процедуру установки Opencart.
    <li>Удалям папку ./public/install.</li>
    <li>В докер-файл Опенкарт добавляем пользователя:<br>
        && usermod -u 1000 www-data && groupmod -g 1000 www-data</li>
    <li>Обязательно отключаем кеширование. 
        Файл system\library\template\Twig\Environment.php<br>    
    За это отвечает строка:
    $this->debug = (bool) $options['debug'];    
    Поэтому надо заменить в настройках false на true:<br>    
    $options = array_merge(array(
             'debug' => false, ...
             </li>
    <li>Не забываем активировать функцию dump в twig-файлах для удобства отладки (см. ниже).</li>
    <li>Пользуемся проектом.</li>
</ol>

Включение функции dump() в twig-файлах opencart 3.0 :
<ol>
    <li>Заходите в system/library/template/Twig/Environment.php</li>
    <li>В конструкторе находите массив $options. Устанавливаете 'debug' в 'true'.</li>
    <li>Теперь добавляете ниже подключение расширения:<br>
    $this->addExtension(new Twig_Extension_Debug()); below.</li>
</ol>


Должно работать.
