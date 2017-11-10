# iTunes Search

## Quick Start

First, you'll need to export your iTunes Library. If you export it as a file `Library.xml` in your `~/Music/iTunes` directory, the below will work without modification.

```bash
git clone https://github.com/Drarok/itunes-search.git
cd itunes-search
composer install
ln -s ~/Music/iTunes/Library.xml
php search.php 'term' 'multiple terms work too'
```
