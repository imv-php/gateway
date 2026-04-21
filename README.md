# IMV Gateway

[![Latest Version on Packagist](https://img.shields.io/packagist/v/imv/gateway.svg?style=flat-square)](https://packagist.org/packages/imv/gateway)

IMV Gateway API bilan ishlash uchun Laravel paketi. Bu paket orqali Soliq, Pasport, E-IMZO va boshqa davlat xizmatlari ma'lumotlarini osonlik bilan olishingiz mumkin.

## O'rnatish

```bash
composer require imv/gateway
```

Konfiguratsiya faylini nashr qilish:

```bash
php artisan vendor:publish --tag="gateway-config"
```

## Sozlash

`.env` faylingizga quyidagi ma'lumotlarni qo'shing:

```dotenv
GATEWAY_BASE_URL=url
GATEWAY_USERNAME=your_username
GATEWAY_PASSWORD=your_password
```

## Foydalanish

### Facade orqali (STIR bo'yicha ma'lumot olish)

```php
use Imv\Gateway\Facades\Gateway;

// DTO ob'ekti qaytadi
$organ = Gateway::getOrganDataByTin('0000000000');

echo $organ->company->name;
echo $organ->company->tin;
```

### Pasport ma'lumotlarini olish (PINFL bo'yicha)

```php
$passport = Gateway::getPassportInfo('00000000000000');

echo $passport->firstName;
echo $passport->document->document;
```

### E-IMZO xizmatlari

```php
$timestamp = Gateway::getEImzoTimestamp($sign);
echo $timestamp->pkcs7b64;

$verify = Gateway::verifyAttached($pkcs7b64);
echo $verify->status;
```

## Mavjud Metodlar

| Metod | Qaytish turi | Tavsif |
|-------|--------------|--------|
| `getOrganDataByTin($tin)` | `OrganInfo` | STIR bo'yicha tashkilot ma'lumotlari |
| `getTaxOrganInfo($tin)` | `TaxOrganInfo` | Soliq qo'mitasi bo'yicha kengaytirilgan ma'lumot |
| `getPassportInfo($pinfl)` | `PassportInfo` | PINFL bo'yicha pasport ma'lumotlari |
| `getEImzoTimestamp($sign)` | `EImzoTimestamp` | E-IMZO vaqt tamg'asini olish |
| `verifyAttached($pkcs7b64)` | `VerifyAttached` | PKCS7 imzorgi ma'lumotlarini tekshirish |
| `makeAttached($pkcs7b64)` | `Response` | Biriktirilgan imzo yaratish so'rovi |

## Xatoliklarni boshqarish

Agar so'rov muvaffaqiyatsiz bo'lsa yoki API xato qaytarsa, `GatewayException` tashlanadi:

```php
use Imv\Gateway\Exceptions\GatewayException;

try {
    $data = Gateway::getPassportInfo('invalid_pinfl');
} catch (GatewayException $e) {
    echo $e->getMessage(); // API dan kelgan xato xabari
}
```

## Litsenziya

MIT litsenziyasi.
