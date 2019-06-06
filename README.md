# MTK-finland-theme-editor
Theme editor for  MTK maps ( kartat.hylly.org ). Works with locus and should also work with oruxmaps.

Based on project that can be found here https://github.com/pailakka/mtk2garmin

Template file is modified from the file fetched from mtk2garmin project.

## How to modify / add things to template
Run PHP file to generate necessary HTML-page. XML-tempate file is used to to generate editable values. 

Template file uses single moustache-notation `{KEY}`. Naming scheme for is as follows:

*Target type abbreviation* _ *graphical element abbreviation*

ie. RB_EW --> Residental building edge width
    4A_FW --> Road type 4A fill width

File generaton uses javascript to generate the actual XML theme file

### Using theme file with Locus

Too it self can be found here: https://joni-lindqvist.github.io/MTK-finland-theme-editor/generator.html

Copy generated file to `/Locus/mapsVector/_themes/` if existing theme files exist remove the old MTK-theme file

### Using theme file with Orux
[TODO]

## Feature requests / bugs 

Please use issue page for this. If you have a feature request please include screenshot of the graphical element in question.


# Ja sama suomeksi 

Kyseessä on simppeli työkalu LocusMapin kartta-aineiston teeman muuttamiseen. Tuon pitäisi toimia myös OruxMapsin kanssa.

Editori perustuu https://github.com/pailakka/mtk2garmin -projektiin ja kartta-aineistot löytyvät osoitteesta: kartat.hylly.org

### Käyttö Locusilla

Itse työkalu löytyy täältä: https://joni-lindqvist.github.io/MTK-finland-theme-editor/generator.html

Tee haluamasi muutokset työkalulla ja kopioi saatu tiedosto hakemistoon `/Locus/mapsVector/_themes/`. Jos hakemistossa on aiempia teematiedostoja MTK:n karttoja varten, poista ne.

### Käyttö Oruxilla
[TODO]

## Ominaisuuksien lisäykset / bugit
Mieluusti issue osioon. Ominaisuuspyyntöihin kannattaa lisätä kuvankaappaus halutusta karttamerkistä. 


