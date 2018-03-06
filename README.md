<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">SPD Online</h1>
    <br>
</p>

SPD online merupakan project aplikasi web untuk membuat surat tugas secara online di BPS Provinsi Sulawesi Tenggara

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install via Composer

1. git clone https://github.com/wpsaputra/surat-tugas.git
2. composer install
3. restore database surat tugas (22).sql via phpmyadmin
4. Sesuaikan setting database pada file yii2