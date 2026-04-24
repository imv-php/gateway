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

### Soliq / Tashkilot
| Metod | Qaytish turi | Tavsif |
|-------|--------------|--------|
| `getOrganDataByTin($tin)` | `OrganInfo` | STIR bo'yicha tashkilot ma'lumotlari |
| `getTaxOrganInfo($tin)` | `TaxOrganInfo` | Soliq qo'mitasi bo'yicha kengaytirilgan ma'lumot |
| `getOrganCars($tin)` | `Response` | Tashkilot transport vositalari ro'yxati |
| `getOrgBuildingsList($tin)` | `Response` | Tashkilot kadastr binolari ro'yxati |
| `getStaffCount($tin)` | `Response` | Tashkilot xodimlari soni |
| `getDebtInfoJuridic($tin)` | `Response` | Yuridik shaxs qarzdorlik ma'lumotlari |
| `getEntrepreneurRating($tin)` | `Response` | Tadbirkor reytingi |
| `getJuridicLicense($tin)` | `Response` | Yuridik litsenziya ro'yxatga olishlar |

### Moliyaviy hisobotlar
| Metod | Qaytish turi | Tavsif |
|-------|--------------|--------|
| `getFinancialData($quarter, $requestDate, $tin, $year)` | `Response` | Moliyaviy hisobot shakl 2 |
| `getFinancialReport($quarter, $requestDate, $tin, $year)` | `Response` | Moliyaviy hisobot shakl 1 |

### Kadastr / Kommunal xizmatlar
| Metod | Qaytish turi | Tavsif |
|-------|--------------|--------|
| `getCadastrData($cadastralNumber)` | `Response` | Kadastr raqami bo'yicha ma'lumot |
| `getColdWaterData($cadastralNumber)` | `Response` | Sovuq suv balansi (Suvsoz) |
| `getHotWaterData($cadastralNumber)` | `Response` | Issiq suv ma'lumotlari (Veolia) |
| `getGasData($cadastralNumber)` | `Response` | Gaz ma'lumotlari |
| `getTrashData($cadastralNumber)` | `Response` | Chiqindi/axlat ma'lumotlari |
| `getHetDataByCadNumber($cadastralNumber)` | `Response` | Elektr (HET) kadastr bo'yicha |
| `getHetDataBySoato($soato, $licshet)` | `Response` | Elektr (HET) SOATO bo'yicha |
| `getMibEstateBan($cadastralNumber, $pinfl)` | `Response` | MIB ko'chmas mulk taqiqi tekshiruvi |

### Fuqaro / Shaxsiy ma'lumotlar
| Metod | Qaytish turi | Tavsif |
|-------|--------------|--------|
| `getPassportInfo($pinfl, $birthDate, $document, $isPhoto)` | `PassportInfo` | PINFL bo'yicha pasport ma'lumotlari |
| `getWorkplace($pinfl)` | `Response` | Joriy ish joyi ma'lumotlari |
| `getMentalIllness($pinfl)` | `Response` | Ruhiy salomatlik reestri |
| `getNarcologist($pinfl)` | `Response` | Narkologiya reestri |
| `getSocialProtection($pinfl)` | `Response` | Ijtimoiy himoya ma'lumotlari |
| `getFamilyReestr($pinfl)` | `Response` | Oila reestri (IHMA) |
| `getYattData($pinfl)` | `Response` | YATT tadbirkor ma'lumotlari |
| `getSchoolChildrenInfo($pinfl)` | `Response` | Maktab o'quvchilari ma'lumotlari |
| `getWomenService($pinfl, $passportSn)` | `Response` | Ayollar xizmati tekshiruvi |
| `getYouthDaftar($passportNumber, $passportSeria, $pinfl)` | `Response` | Yoshlar daftari tekshiruvi |

### Qarzdorlik / MIB
| Metod | Qaytish turi | Tavsif |
|-------|--------------|--------|
| `getMibDebt($tin, $senderPinfl)` | `Response` | MIB qarzdor ijro so'rovi |

### Sudlanganlik
| Metod | Qaytish turi | Tavsif |
|-------|--------------|--------|
| `sendConvictionSearch(...)` | `Response` | Sudlanganlik qidiruvi yuborish |
| `getConvictionCheck($queryId)` | `Response` | Sudlanganlik natijasini tekshirish |

### E-IMZO (Raqamli imzo)
| Metod | Qaytish turi | Tavsif |
|-------|--------------|--------|
| `getEImzoTimestamp($sign)` | `EImzoTimestamp` | E-IMZO vaqt tamg'asini olish |
| `verifyAttached($pkcs7b64)` | `VerifyAttachedResponse` | PKCS7 imzorgi ma'lumotlarini tekshirish |
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
