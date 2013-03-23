**Refactoring példa**

A feladat a példánál az, hogy csináljunk egy beléptető rendszert struktúrált programozással, amit aztán oo-ra alakítunk.

A beléptető rendszer 3 oldalból fog állni: login, logout, profile.
A login csak jelszót kér be, amit magának küld el, és összehasonlítja az aktuálissal. Mivel csak egy jelszó lesz, ezért adatbázisra nincs szükség, elég egy json vagy xml fájlban letárolni.

**Flow**

Csináljuk meg a feldolgozót, ami ellenőrzi a jelszót.

&#8730; Először szórjuk össze a login űrlapot.