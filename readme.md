**Refactoring példa**

A feladat a példánál az, hogy csináljunk egy beléptető rendszert struktúrált programozással, amit aztán oo-ra alakítunk.

A beléptető rendszer 3 oldalból fog állni: login, logout, profile.
A login csak jelszót kér be, amit magának küld el, és összehasonlítja az aktuálissal. Mivel csak egy jelszó lesz, ezért adatbázisra nincs szükség, elég egy json vagy xml fájlban letárolni.

**Flow**

A View-oknál a hibaüzeneteket jobb, ha konstruktorral injektálom be, mint hogy emiatt külön osztályok legyenek.

&#8730; A Container átadása a View-oknak nagyon sokszor szerepel a kódokban. Ezzel lehetne valamit kezdeni...

    A html-t lehetne példányosítani az AbstractView-ban is akár, úgy eltűnne ez a probléma.

&#8730; A view-nál érdemes lenne eltüntetni az anonim függvényt, és egy metódust betenni a helyére callback-nek.

&#8730; Sok a Profile-al kapcsolatos use bejegyzés az AuthController-ben. Át kell rakni másik Controller-be a profile action-t.

    Egyelőre még az AuthInput és az AuthModel, amit használ. A profile-hoz tartozó kódot, ki kell emelni ezekből az osztályokból.
    Az AuthInput-nak nincs semmivel közös kódja, több űrlap kéne, hogy általános részt ki lehessen emelni belőle.
    A ProfileModel-t megcsináltam. A ProfileController-ben még mindig szerepel az AuthModel a jogosultság ellenőrzés miatt.
    A jogosultság ellenőrzést egy szinttel feljebb lehetne tenni, ha lenne még olyan controller vagy action, ami használja.

&#8730; Van egy csomó Auth kezdetű osztályunk, azokat érdemes lenne összevonni egyetlen névtérbe.

&#8730; Rendezzük egy kicsit a névtereket, hogy jobban látszódjon mi melyik réteghez tartozik.

&#8730; Csináljunk sima osztályt az összes statikusból. Aminél olyanok a konstansok, azokat tegyük be a Container-be.

&#8730; Az AuthModel és a Store példányok közvetlen átadása helyett adjuk át magát a Container-t.

    Így nem kell bajlódni azzal, hogy egy csomó setter metódust vagy constructor paramétert adjunk meg.
    Mellesleg gyorsabb lesz a kód tőle, mert nem példányosítja az egyes osztályokat, csak amikor szükség van rájuk.
    A Container-ben a sok !isset-es ismétlődést csak úgy lehet kiváltani, ha __call-ra tesszük az adatok kérését.
    A __call esetében viszont elveszik többek között az automatikus kiegészítés.
    További hátránya a mostani változatnak, hogy nincs típusellenőrzés a container-rel megadott paraméterekre.
    A típusellenőrzést az egyes osztályokbak setterekkel lehet megoldani. Nekem most nincs rá szükségem, mert kicsi a kód.

&#8730; El kell érni, hogy az AuthModel-ben cserélhető legyen a JsonStore bármilyen másik Store interface-t implementáló megoldásra.

    Egyelőre betettem az AuthModel-be a Store példányosítást. Kénytelen voltam a bootstrapből kiszedni a json fájl helyét.
    A példányosítás nem az AuthModel feladata, ez több dologból is elég tisztán látszik.
    Az egyik ilyen, hogy több absztrakciós szint van jelen az osztályban, ezt a protected jelzi.
    A másik, hogy minden alkalommal meg kell nézni, hogy megvan e a példány egy-egy store-ból, amikor elkérjük.
    A harmadik, hogy két dolgot csinál az AuthModel, példányosít, és kezelő a felhasználó azonosítást.
    Tegyük egy absztrakciós szinttel feljebb a Store példányosítást.
    Máris egy fokkal jobb, most viszont a Controller-be került a példányosítás, ami szintén nem jó.
    Tegyük még feljebb. Most a Router-ben van. Ott már majdnem jó, de az is két dolgot csinálna, tegyük még feljebb.
    A Bootstrap-ben sincs jó helyen, mert ő az autoload-ot állítja be, az absztrakciós szint viszont megfelelő.
    Ezt onnan látni, hogy már a Router-nél eltűnt a példány meglétét ellenőrző feltétel.
    Szóval a Bootstrap alatt van a megfelelő helye a Routerrel egy szinten.
    Az Autoload-nak is lehet csinálni egy külön osztályt, az is ugyanazon az absztrakciós szinten kell, hogy legyen.
    Most szét van szedve rendesen a példányosítás, de még mindig a Bootstrap-ban van, így az túl sok dolgot csinál.
    Ki kell emelni egy IoC container-be a példányosítást ahhoz, hogy minden okés legyen.
    A Container kódjának cserélésével esetleg config fájlba szervezésével így már tetszőleges Store beállítható.

&#8730; Némileg zavaró az újrahasznosításnál, hogy ki kell írni, hogy redirect vagy display. Csinálni kellene külön RedirectView-okat.

&#8730; Statikus metódus nem lehet absztrakt, emiatt hibát kapok az AbstractView-nál. Át kell írni nem statikusra a View osztályokat.

&#8730; Üzenetküldés a hibák okáról.

    Beszórtam try-catch blokkba a controller-ben található kódot, leírtam a commentekben, hogy melyik mikor fut le.
    Jelenleg még úgy tűnik, hogy ismétlődő kód van néhány helyen, de ez azért van, mert nem adtam át a hibaüzeneteket.
    Az adat tárolási hibára nincs felkészítve a rendszer, azzal is kezdeni kell valamit.

&#10005; A jelszó tároló osztály nem cserélhető ki valami könnyen, mert bele van kódolva az AuthModel-be a használata.

    Elég lenne azt beírni a kódba, hogy minden DataStore interface-t teljesítő osztályt használhat.
    Ezt osztályok nevének átadásával lehetne megoldani, ami nehéz módosíthatósághoz vezetne.
    Ha példányosítanám ezeket a tároló osztályokat, akkor nem lenne szükség az osztály név átadására.

&#10005; Sok helyen ismétlődik a false-re ellenőrzés. Ez erősen összefügg a hibakezeléssel.

    A kivételek dobásához nem elegek a statikus osztályok.
    A kivételeket példányosítani kell.

&#10005; Az AuthController-t szét lehetne vágni, hogy kövesse a View mintáját, tehát legyen külön ProfileView és külön AuthView.

    Ez a probléma akkor is nagyon hamar jelentkezne, ha több funkcióval bővítenénk az alkalmazást.
    Ehhez bele kell nyúlni a Router-be, mert csak egy Controller-t támogat a jelenlegi formájában.
    A Router módosítása szintén elég nehézkes statikus osztályokkal.
    A fő gond ott van, hogy szövegesen kell megadni az osztályneveket, ezért azok nehezen módosíthatóak.
    Ehhez már nem elég statikus osztályok használata. Anonim függvényekkel megoldható, de nem lenne annyira rendezett, mint a mostani változat.

&#10005; A Html form metódus hívásai ilyenek.

    Át lehetne őket tervezni, de ahhoz már nem biztos, hogy elegek a statikus osztályok.

&#8730; Keressünk további kódrészleteket, amik ismétlődnek.

&#8730; A Session-nél is ugyanígy lehetne a DataStore interface-t használni, elvégre ő is adatot ment.

&#8730; Meg kell nézni, hogy a DataStore és a HashStore felcserélhető e, lehet, hogy nincs is szükség külön tömbben tárolásra json-ban.

    Ez mondjuk saját tudatlanságból alakult így. Ezzel kapcsolatban érdemes egy Store interface-t definiálni.

&#8730; Nem tiszta az AbstractView szerkezete, a display metódus paraméter listája eltérő a ProfileView esetében.

    Kiemeltem külön metódusba. Betettem egy interface-t, ami leírja, hogy hogyan kell kinézni egy View-nak.
    Az interface-ek megvédenek attól, hogy véletlen felülírjad az eredeti paraméterlistákat örököltetésnél.
    A ProfileView osztály több dolgot csinál, mint kellene neki, ezt az is jelzi, hogy displayUpdated kint van a View interface-ből.
    Továbbörököltettem a ProfileView-ot, most már minden publikus metódusa bent van a View interface-ben, szóval úgy néz ki, mint bármelyik View.

&#8730; Ki kell emelni az azonos kódot külön osztályba, hogy ne ismétlődjön.

    A probléma itt az, hogy a külön osztálynak át kell adni a paramétereket. Így viszont értelmetlen létrehozni, mert nem változik semmit az azonos kód.
    Helyette csináltam egy absztrakt osztályt, amitől örököltetem az azonos kódot, így mindkét leszármazott megkapja azt.

&#8730; Az AuthView két dolgot csinál, kirajzolja a bejelentkezős oldalt és a profil oldalt is. Ez ütközik az SRP elvbe, szét kell vágni két osztályra.

    Szétvágtam, viszont vannak nagyon hasonló részek a két View osztályban, érdemes lenne őket azonosan elnevezni.

&#8730; A DataStore-nál át kell írni a mentés helyét, mert nem kapja meg, hogy az alkalmazás éppen milyen mappában van. Ezt kéne valahogyan megoldani.

&#8730; Csináljunk külön osztályt az autoloader-hez is, tegyük az Application mappába az alkalmazásunkat, hogy a Router ne az index.php-val legyen egy szinten.

&#8730; Emeljük ki a konstansokat külön osztályváltozókba.

    Az AuthView-nál látható, hogy elég nehezen boldogulunk a konstansok átadásával. Azért egy kis trükközéssel megoldható.
    A Redirect kódja rossz helyen van. Ezt többek között abból látni, hogy hasonlóak a konstansok, mint az AuthView-nál.

&#8730; Rendezzük egy kicsit a metódus- és osztályneveket.

&#8730; Tegyük át névterekbe és osztályokba a mostani kódot, és írjunk hozzá autoloader-t. Úgy jobban követhetőek lesznek a függőségi viszonyok.

&#10005; Csináljunk felhasználóbarát hibaüzenetet arról, hogy miért nem működött a bejelentkezés, vagy bármi egyéb. Loggoljuk a hibákat.

    Minden függvény false-t ad vissza hiba esetén, ezt viszont csak nagyon sok munkával lehetne átírni használhatóra.
    A kivételeket, try-catch blokkot az oo programozásban pont erre találták ki, szóval felesleges feltalálni a spanyol viaszt.

&#10005; Csináljunk autoloader-t, hogy ne kelljen kiírni a require-t minden függőséghez. Így a fájlok tetszőleges logika szerint áthelyezhetőek lesznek.

    Php-ben csak osztályokra működik az autoload-er. Így viszont ha bármi változik a könyvtárszerkezetben, akkor minden require-t egyesével át kell írni.
    Előbb, vagy utóbb túl nagyok lesznek a rétegek fájljai, szét kell bontani őket, és rengeteg require-t át kell majd írni emiatt.

&#10005; Tegyünk prefix-et minden egyes függvényhez, hogy lássuk, melyik függvény melyik réteghez tartozik. Ennek további előnye, hogy újra felhasználható lesz egy-egy függvény név tőle, ill. hogy ránézésre tudjuk mit hol keressünk.

    Nagyon hamar kiderül, hogy ez nem járható út, mert nagyon hosszú függvénynevek lesznek.
    Előbb, vagy utóbb viszont elfogynak a felhasznált nevek, úgyhogy muszáj lesz névtereket vagy osztályokat használni.

&#8730; Csináljunk front controller-t, hogy újra tudjuk hasznosítani a require sorokat a wwwroot-ban lévő fájlokban.

    Nem volt szükség a front controllerre az újrahasznosításban, anélkül is ment.
    Ettől függetlenül megvalósítottam, hogy levédjem a store.json fájlt.

&#8730; Tegyük külön fájlokba az egyes rétegeket.

    wwwroot - kérések kezelése
        Controller
            input - űrlap adatok beolvasása
        Model
            session - állapot tárolása, változtatása a munkamenetben
                access - hash készítés és tárolás
                    crypto - hash készítés
                    hashStore - hash tárolás
                        store - adatok config fájlba írása
        View
            document - konkrét oldalak megjelenítése
                html - html komponensek
            redirect - konkrét oldalakra átirányítás

&#8730; Dolgozzunk még egy kicsit az ismétlődések eltüntetésén.

&#8730; A kód ismétlődéseket tegyük ki külön fájlokba.

&#8730; Adjunk hozzá logout lehetőséget.

&#8730; Adjuk hozzá az állapot tárolását a munkamenetben.

&#8730; Csináljuk meg a profil oldalt egyelőre jogosultság ellenőrzés nélkül, és 
állítsunk be egy jelszót.

&#8730; Csináljuk meg a feldolgozót, ami ellenőrzi a jelszót.

&#8730; Először szórjuk össze a login űrlapot.