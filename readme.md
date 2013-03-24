**Refactoring példa**

A feladat a példánál az, hogy csináljunk egy beléptető rendszert struktúrált programozással, amit aztán oo-ra alakítunk.

A beléptető rendszer 3 oldalból fog állni: login, logout, profile.
A login csak jelszót kér be, amit magának küld el, és összehasonlítja az aktuálissal. Mivel csak egy jelszó lesz, ezért adatbázisra nincs szükség, elég egy json vagy xml fájlban letárolni.

**Flow**

Meg kell nézni, hogy a DataStore és a HashStore felcserélhető e, lehet, hogy nincs is szükség külön tömbben tárolásra json-ban.

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