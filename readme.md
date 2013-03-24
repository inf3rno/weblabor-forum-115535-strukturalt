**Refactoring példa**

A feladat a példánál az, hogy csináljunk egy beléptető rendszert struktúrált programozással, amit aztán oo-ra alakítunk.

A beléptető rendszer 3 oldalból fog állni: login, logout, profile.
A login csak jelszót kér be, amit magának küld el, és összehasonlítja az aktuálissal. Mivel csak egy jelszó lesz, ezért adatbázisra nincs szükség, elég egy json vagy xml fájlban letárolni.

**Flow**

Tegyük külön fájlokba az egyes rétegeket.
&#8730; Dolgozzunk még egy kicsit az ismétlődések eltüntetésén.
&#8730; A kód ismétlődéseket tegyük ki külön fájlokba.
&#8730; Adjunk hozzá logout lehetőséget.
&#8730; Adjuk hozzá az állapot tárolását a munkamenetben.
&#8730; Csináljuk meg a profil oldalt egyelőre jogosultság ellenőrzés nélkül, és állítsunk be egy jelszót.
&#8730; Csináljuk meg a feldolgozót, ami ellenőrzi a jelszót.
&#8730; Először szórjuk össze a login űrlapot.