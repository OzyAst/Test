## Запуск
```
> composer install
> cp App/config/bd-example.php App/config/bd.php 
```

## ЗАДАЧА

Есть 2 таблицы credits и payments.

credits:
- id        - auto_increment
- cred_no   - номер договора
- cred_date - дата договора
- cred_sum  - сумма договора

payments:
- id       - auto_increment
- cred_id  - ссылка на таблицу credits 
- data_set - blob с сериализованными данными по транзакции (overdue, payment)

Нужно написать php-приложение, которое:
1. вытащит все записи из таблицы payments у которых нет соответствующей записи в таблице credits
2. для записей с просрочкой, отличной от нуля, сформирует xml-файл вида:

    ```xml
   <?xml version="1.0" encoding="UTF-8"?>
    <payments>
        <payment id="payment_id_value">
            <cred_id>cred_id_value</cred_id>
            <overdue>overdue_value</overdue>
        </payment>
        ...
        <payment id="payment_id_value">
            <cred_id>cred_id_value</cred_id>
            <overdue>overdue_value</overdue>
        </payment>
    </payments>
    ```

3. Проверит средствами XML валидность сформированного XML-файла.
Предполагается, что значение payment id и cred_id может быть только целочисленным, 
а значение overdue_value - положительным числом с плавающей точкой.
cred_id записей, непрошедших проверку, нужно поместить в отдельный лог-файл.

Ограничения - скрипт должен выполняться при 8Мб оперативной памяти.