# Modulity: Modüler Tasarım İçin Bir PHP Paketi

Modulity, PHP için özellikle API geliştiricileri için tasarlanmış bir modüler tasarım paketidir. Laravel framework'üne kolayca entegre edilebilir ve proje geliştirme sürecinde tekrarlayan görevleri azaltmak için tasarlanmıştır. Modulity, yeni modüller oluşturmanıza, hizmet ve depo katmanları oluşturmanıza ve projenizde modüllerin yönetilmesine olanak tanır.

Modulity, yeni bir modül, hizmet veya depo oluşturma gibi görevleri hızlı ve kolay bir şekilde yerine getirmenizi sağlayan kullanımı kolay bir CLI (command-line interface) sağlar. Ayrıca, Modulity, Artisan ile entegredir, bu da Modulity komutlarını Artisan komutları olarak çalıştırmayı kolaylaştırır.

## Kurulum

Modulity paketini kullanmaya başlamak için öncelikle Composer aracılığıyla paketi yüklemeniz gerekir. Terminalde aşağıdaki komutu kullanarak paketi yükleyin:

```shell
composer require kodarsiv/modulity
```
Bu işlemin ardından config dosyasını publish etmeniz gerekmektedir :
```shell
php artisan vendor:publish --provider="Kodarsiv\Modulity\Providers\ModulityServiceProvider" --tag=modulity-config
```

## Mevcut Komutlar

**Module :** _Verilen isimded yeni bir modül yapısı oluşturur._
```shell
php artisan modulity:make {moduleName}
```

**Service :** _Mevcut bir modül için yeni bir Service dosyası oluşturur. 
Burada Servis ismi yeterlidir sonuna `Service` Yazmayiniz._
```shell
php artisan modulity:service {moduleName} {ServiceName}
```

**Repository :** _Mevcut bir modül için yeni bir Repository dosyası oluşturur. 
Burada Repository ismi yeterlidir sonuna `Repository` Yazmayiniz._
```shell
php artisan modulity:repository {moduleName} {RepositoryName}
```

**Controller :** _Mevcut bir modül için yeni bir Controller dosyası oluşturur.
Burada Controller ismi yeterlidir sonuna `Controller` Yazmayiniz._
```shell
php artisan modulity:controller {moduleName} {ControllerName}
```
