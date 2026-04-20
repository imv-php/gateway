# IMV Gateway

[![Latest Version on Packagist](https://img.shields.io/packagist/v/imv/gateway.svg?style=flat-square)](https://packagist.org/packages/imv/gateway)
[![Total Downloads](https://img.shields.io/packagist/dt/imv/gateway.svg?style=flat-square)](https://packagist.org/packages/imv/gateway)

IMV Gateway API bilan ishlash uchun Laravel paket. 34 ta davlat e-gov endpoint'lariga (soliq, kadastr, kommunal, fuqaro ma'lumotlari, e-IMZO va boshqalar) qulay interfeys taqdim etadi. OAuth token avtomatik boshqariladi va keshlanadi.

## O'rnatish

```bash
composer require imv/gateway
```

Konfiguratsiya faylini chiqarish:

```bash
php artisan vendor:publish --tag="gateway-config"
```

## Sozlash

`.env` fayliga quyidagi o'zgaruvchilarni qo'shing:

```dotenv
GATEWAY_BASE_URL=https://gateway.imv.uz
GATEWAY_USERNAME=your-username
GATEWAY_PASSWORD=your-password
GATEWAY_CACHE_KEY=gateway_tokens
GATEWAY_CONNECT_TIMEOUT=15
GATEWAY_REQUEST_TIMEOUT=30
```

Faqat `GATEWAY_USERNAME` va `GATEWAY_PASSWORD` majburiy. Qolganlari standart qiymatlarga ega.

## Foydalanish

### Facade orqali

```php
use Imv\Gateway\Facades\Gateway;

$response = Gateway::getOrganInfo('123456789');
$data = $response->json();
```

### Dependency Injection orqali

```php
use Imv\Gateway\Gateway;

class MyController
{
    public function show(Gateway $gateway, string $tin)
    {
        $response = $gateway->getOrganInfo($tin);
        return $response->json();
    }
}
```

### DTO bilan ishlash

Javobni DTO ga aylantirish mumkin:

```php
use Imv\Gateway\Data\OrganInfo;
use Imv\Gateway\Facades\Gateway;

$response = Gateway::getOrganInfo('201122919');
$dto = OrganInfo::fromResponse($response);

$dto->tin;          // '201122919'
$dto->name;         // Tashkilot nomi
$dto->director;     // Director yoki null
$dto->companyBanks; // CompanyBank[] yoki null
$dto->toArray();    // Massivga aylantirish
$dto->toJson();     // JSON ga aylantirish
```

## Mavjud metodlar

Barcha metodlar `Saloon\Http\Response` qaytaradi. `->json()` — javobni massiv sifatida olish, `->body()` — xom string.

### Soliq / Tashkilot

| Metod | Parametrlar | Tavsif |
|-------|------------|--------|
| `getOrganInfo(tin)` | `string $tin` | Soliq reestridagi tashkilot ma'lumotlari |
| `getOrganDataByTin(tin)` | `string $tin` | Yuridik shaxs ma'lumotlari (STIR bo'yicha) |
| `getOrganCars(tin)` | `string $tin` | Tashkilot transport vositalari ro'yxati |
| `getOrgBuildingsList(tin)` | `string $tin` | Tashkilot kadastr binolari ro'yxati |
| `getStaffCount(tin)` | `string $tin` | Tashkilot xodimlari soni |
| `getDebtInfoJuridic(tin)` | `string $tin` | Yuridik shaxs qarzdorlik ma'lumotlari |
| `getEntrepreneurRating(tin)` | `string $tin` | Tadbirkor reytingi (mahalla mezonlari) |
| `getJuridicLicense(tin)` | `string $tin` | Yuridik litsenziya ro'yxatga olishlar |

### Moliyaviy hisobotlar

| Metod | Parametrlar | Tavsif |
|-------|------------|--------|
| `getFinancialData(quarter, requestDate, tin, year)` | `string` x4 | Moliyaviy hisobot shakl 2 |
| `getFinancialReport(quarter, requestDate, tin, year)` | `string` x4 | Moliyaviy hisobot shakl 1 |

### Kadastr / Kommunal xizmatlar

| Metod | Parametrlar | Tavsif |
|-------|------------|--------|
| `getCadastrData(cadastralNumber)` | `string $cadastralNumber` | Kadastr raqami bo'yicha ma'lumot |
| `getColdWaterData(cadastralNumber)` | `string $cadastralNumber` | Sovuq suv balansi (Suvsoz) |
| `getHotWaterData(cadastralNumber)` | `string $cadastralNumber` | Issiq suv ma'lumotlari (Veolia) |
| `getGasData(cadastralNumber)` | `string $cadastralNumber` | Gaz ma'lumotlari |
| `getTrashData(cadastralNumber)` | `string $cadastralNumber` | Chiqindi/axlat ma'lumotlari |
| `getHetDataByCadNumber(cadastralNumber)` | `string $cadastralNumber` | Elektr (HET) kadastr bo'yicha |
| `getHetDataBySoato(soato, licshet)` | `string $soato`, `string $licshet` | Elektr (HET) SOATO bo'yicha |
| `getMibEstateBan(cadastralNumber)` | `string $cadastralNumber` | MIB ko'chmas mulk taqiqi tekshiruvi |

### Fuqaro / Shaxsiy ma'lumotlar

| Metod | Parametrlar | Tavsif |
|-------|------------|--------|
| `getUserData(pinfl, isPhoto?, birthDate?)` | `string $pinfl`, `bool $isPhoto = false`, `?string $birthDate = null` | PINFL bo'yicha pasport ma'lumotlari |
| `getWorkplace(pinfl)` | `string $pinfl` | Joriy ish joyi ma'lumotlari |
| `getMentalIllness(pinfl)` | `string $pinfl` | Ruhiy salomatlik reestri tekshiruvi |
| `getNarcologist(pinfl)` | `string $pinfl` | Narkologiya reestri tekshiruvi |
| `getSocialProtection(pinfl)` | `string $pinfl` | Ijtimoiy himoya ma'lumotlari |
| `getFamilyReestr(pinfl)` | `string $pinfl` | Oila reestri (IHMA) |
| `getYattData(pinfl)` | `string $pinfl` | YATT tadbirkor ma'lumotlari |
| `getSchoolChildrenInfo(pinfl)` | `string $pinfl` | Maktab o'quvchilari ma'lumotlari (UzEdu) |
| `getWomenService(pinfl, passportSn)` | `string $pinfl`, `string $passportSn` | Ayollar xizmati tekshiruvi |
| `getYouthDaftar(passportNumber, passportSeria, pinfl)` | `string` x3 | Yoshlar daftari tekshiruvi |

### Qarzdorlik / MIB

| Metod | Parametrlar | Tavsif |
|-------|------------|--------|
| `getMibDebt(tin)` | `string $tin` | MIB qarzdor ijro so'rovi |

### Sudlanganlik

| Metod | Parametrlar | Tavsif |
|-------|------------|--------|
| `sendConvictionSearch(firstname, lastname, middlename, passport, pinfl?, regionId?)` | `string` x4, `?string` x2 | Sudlanganlik qidiruvi yuborish |
| `getConvictionCheck(queryId)` | `string $queryId` | Sudlanganlik qidiruv natijasini tekshirish |

### E-IMZO (Raqamli imzo)

| Metod | Parametrlar | Tavsif |
|-------|------------|--------|
| `timestamp(sign)` | `string $sign` | Imzoga vaqt tamg'asi qo'yish |
| `makeAttached(pkcs7b64)` | `string $pkcs7b64` | Biriktirilgan PKCS7 imzoni tekshirish |

## DTO lar

`getOrganInfo` uchun `OrganInfoDTO` mavjud. Javobni DTO ga aylantirish:

```php
$dto = OrganInfoDTO::fromResponse($response);
```

**OrganInfoDTO** tarkibidagi nested DTO lar:

| Xususiyat | Turi | Tavsif |
|-----------|------|--------|
| `director` | `?DirectorDTO` | Rahbar ma'lumotlari |
| `companyBanks` | `?CompanyBankDTO[]` | Bank hisoblari |
| `companyBillingAddress` | `?AddressDTO` | Yuridik manzil |
| `directorAddress` | `?AddressDTO` | Rahbar manzili |
| `companyExtraInfo` | `?CompanyExtraInfoDTO` | Qo'shimcha ma'lumot (xodimlar soni) |
| `founders` | `?FounderDTO[]` | Ta'sischilar ro'yxati |
| `companyShippingAddress` | `?array` | Yetkazib berish manzillari |

Barcha maydonlar nullable — API `null` qaytarsa xato bermaydi.

## Xatolarni boshqarish

Barcha metodlar muvaffaqiyatsiz javoblarda `GatewayException` tashlaydi:

```php
use Imv\Gateway\Exceptions\GatewayException;
use Imv\Gateway\Facades\Gateway;

try {
    $response = Gateway::getOrganInfo('123456789');
    $data = $response->json();
} catch (GatewayException $e) {
    // $e->getMessage() — API dan kelgan xato xabari
    // $e->response — asl Saloon Response
    logger()->error('Gateway xatosi: ' . $e->getMessage());
}
```

## Autentifikatsiya

Autentifikatsiya `GatewayAuthenticator` orqali avtomatik boshqariladi:

1. Sozlangan username/password yordamida OAuth token so'raydi
2. Tokenni Laravel keshi orqali saqlaydi (kalit: `gateway_tokens`)
3. Muddati tugashidan oldin tokenni avtomatik yangilaydi
4. Har bir so'rovga `Authorization: Bearer {token}` sarlavhasini biriktiradi

Qo'lda token boshqarish talab etilmaydi.

## Testlash

```bash
composer test
```

## O'zgarishlar tarixi

Batafsil ma'lumot uchun [CHANGELOG](CHANGELOG.md) ga qarang.

## Litsenziya

MIT litsenziyasi. Batafsil ma'lumot uchun [License File](LICENSE.md) ga qarang.
