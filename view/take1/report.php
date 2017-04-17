<div class="outer-wrap outer-wrap-report">
    <div class="inner-wrap inner-wrap-report">
        <div class="row">
            <main class="site-main site-report">

                <section>
                    <p>7:e april 2017</p>
                    <h2>Kmom01: Objektorientering i PHP</h2>

                    <p>Så var också OOPHP-kursen igång och vilken start. Riktigt mastigt kursmoment som tog mycket längre tid att göra än beräknat. Dels pga. behov av att fräscha upp minnet med PHP, men också SQL. För att inte tala om utvceklingsmiljön som bara den tog en god stund att få igång. Dock var det ingen av delarna som direkt var för svår. Mer att det tog lång stund att gå igenom alla övningar artiklar, förstå det hela och sedan implementera det.</p>

                    <p>Guess-uppgiften var lite trögstartad för min del. Mest pga. att det var ett tag sen jag höll på med PHP. När jag väl hade kommit in i PHP:andet igen så gick det rätt smärtfritt med de olika del-spelen. Smidigt att lagra hela spelet som ett objekt i $_SESSION. Jag gav spelet en enkel styling med hjälp av ett Bootstrap-tema från Bootswatch.</p>

                    <p><strong>Hur känns det att hoppa rakt in i klasser med PHP, gick det bra?</strong></p>

                    <p>Vid det här laget börjar jag få rätt bra koll på klasser, i och med tidigare oopython och linux-kursen. Med tanke på detta så gick det rätt smidigt att komma igång med det i också PHP. Jag kan tycka att PHP:s syntax är något ovan i och med hur man anropar metoder mm. Känns dock så här i slutet på första kursmomentet som att det börjar sätta sig.</p>

                    <p><strong>Berätta om dina reflektioner kring ramverk, anax-lite och din me-sida.</strong></p>

                    <p>Att bygga sitt egna ramverk var något som jag initialt såg fram emot med den här kursen. Så här en bit in så tycker jag den beskrivningen av kursen/momentet är rätt rejält missvisande. Här blir det väldigt mycket klipp-och-klistra samt importerande av färdiga moduler. Synd!</p>

                    <p>Jag förstår dock att det kanske inte är det som menades och att vi nu mera ska få koll på hur ramverk är uppbyggda och vilka frundfunktioner som finns med. Och det är väl inte fel och en vettig ända att börja i. Något som så här långt lyckas.</p>

                    <p>Mitt ramverk och min me-sida har jag mer koll på nu än i den tidigare design-kursen. Just att vi implemeenterar alla moduler steg för steg gör att man får bättre koll på alla mappar/filer. Vad som finns var och vad som gör vad.</p>

                    <p>Jag har försökt separera PHP-kod och HTML-kod så gott det går. Lagt all PHP-kod högst upp i filerna och sedan inkluderat den genererade HTML-koden med short-taggar.</p>

                    <p>När det kommer till stylingen så använder jag mig av LESS. Jag har dock än så länge inte börjat bygga det i någon tema-mapp eller med hjälp av Makefiler. Det får komma senare.</p>

                    <p><strong>Gick det bra att komma igång med MySQL, har du liknande erfarenheter sedan tidigare?</strong></p>

                    <p>Den tidigare erfarenhet jag har av SQL sträcker sig till de tidigare kurserna i programmet. Det här kändes som en bra repetition samt en bra introduktion till flera nya delar. En bra artikel med bra övningar. Under det här kursmomentet gjorde jag till och med uppgift 8.2.</p>

                    <a href="http://www.student.bth.se/~toab16/dbwebb-kurser/oophp/me/kmom01/guess/"> Mitt Guess-spel</a>
                </section>

                <section>
                    <p>16:e april 2017</p>
                    <h2>Kmom02: OO-programmering i PHP</h2>

                    <p>Också kmom02 visade sig vara ett rätt mastigt moment som tog en hel del tid att göra. Kanske mest för att jag snurrade till det lite när jag skulle göra min kalender. Fick dock till det till slut.</p>

                    <p>Kul att jobba vidare med navbaren också. Jag gjorde en rekursiv funktion som även hanterar undermenyer. Nu gäller det bara att ordna till css:en för de också.</p>

                    <p><strong>Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar med de olika sätten?</strong></p>

                    <p>Jag tycker det känns mycekt smidigt att skriva koden som moduler. Som man sedan kan importera in i olika projekt helt fristående. Jag tycker även att som jag har fjort nu med att importera mina moduler in i $app är riktigt smidigt då man då får tillgång till dem överallt. Dock kan det ju kanske bli lite mycket onödig kod som hänger med inne i $app fast det inte behövs. Så när ens ramverk/projket växer känns det som att det är något att titta närmare på och bara importera de moduler som behövs just för stunden.</p>

                    <p><strong>Hur väljer du att organisera dina vyer?</strong></p>

                    <p>I min vy-mapp har jag gjort en del undermappar. Jag har en take1-mapp där de flesta av basvyerna ligger än så länge tills jag får för mig att ändra på dem. Sen har jag en mapp/navbar och sen varsion mapp med vyer för session och calendar. Jag tycker det blir mer överkådligt när det blir mer uppdelat. Det gör också att det är enkelt att lägga till/ta bort vyer som hör till en specifik modul.</p>

                    <p><strong>Berätta om hur du löste integreringen av klassen Session.</strong></p>

                    <p>Jag la till session som en del av $app. Därefter så startar jag igång sessionen först i vyerna då det inte alltid behövs en aktiv session. Vidare så sköter jag mestadelen av logiken i routerna förrutom länkarna för de olika knapparna som genereras i vyn.</p>

                    <p><strong>Berätta om hur du löste uppgiften med Tärningsspelet 100/Månadskalendern, hur du tänkte, planerade och utförde uppgiften samt hur du organiserade din kod?</p>

                    <p>Jag valde att göra en månadskalender då det kändes som att det är något som man kan använda sig av senare och för att öva på att hantera datum och tid.</p>

                    <p>Jag hittade en hel del användbara objekt och metoder i Datetime i PHP-manualen så jag försökte använda mig så mycket som möjligt av det.</p>
                    
                    <p>Jag börjar med att skapa en array av alla månadens dagar med hjälp av Dateperiod och Dateinterval. Sedan splitas denna array upp i veckor i en 2-dimensionel array. Därefter kör jag en metod som "paddar" veckorna så alla blir 7 långa för att underlätta för utskrift. Och till sist så loopar jag igenom samtliga veckor och genererar html-koden för dessa. Här har jag några funktioner för att underlätta med detta som att bygga html-kod för en vecka osv.</p>
                    
                    <p>Jag har även några hjälp-metoder för att hämta år och månad.</p>
                    
                    <p>I min vy för kalendern blev det tyvärr en hel del PHP-kod, mestadels för att hålla koll på POST-variabler mm men då tiden var knapp fick jag nöja mig så här.</p>

                    <p><strong>Några tankar kring SQL så här långt?</p>

                    <p>Kul att se vad man kan göra med SQL-kod mot en databas och hur och vilken data man kan hämta ut. Än så länge tycker jag det flyter på bra.</p>

                </section>

            </main>
        </div>
    </div>
</div>
