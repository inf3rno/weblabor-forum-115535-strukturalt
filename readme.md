**Refactoring példa**

A feladat a példánál az, hogy csináljunk egy beléptető rendszert struktúrált programozással, amit aztán oo-ra alakítunk.

A beléptető rendszer 3 oldalból fog állni: login, logout, profile.
A login csak jelszót kér be, amit magának küld el, és összehasonlítja az aktuálissal. Mivel csak egy jelszó lesz, ezért adatbázisra nincs szükség, elég egy json vagy xml fájlban letárolni.

**Flow**

Tegyünk prefix-et minden egyes függvényhez, hogy lássuk, melyik függvény melyik réteghez tartozik. Így újra felhasználható lesz egy-egy függvény név.

&#8730; Csináljunk front controller-t, hogy újra tudjuk hasznosítani a require sorokat a wwwroot-ban lévő fájlokban.

    Nem volt szükség a front controllerre az újrahasznosításban, anélkül is ment.
    Ettől függetlenül megvalósítottam, hogy levédjem a config.json fájlt.

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