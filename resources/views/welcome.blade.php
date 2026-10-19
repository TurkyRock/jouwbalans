<x-layouts.balance title="Lekkerder in je vel">
    <div class="scrapbook-home">
        <div class="page-edge-decoration" aria-hidden="true">
        <img class="page-botanical edge-left" src="{{ asset('images/balance/botanical-edge-v5.webp') }}" alt="" aria-hidden="true" width="710" height="2048">
        <img class="page-botanical edge-right" src="{{ asset('images/balance/botanical-edge-v5.webp') }}" alt="" aria-hidden="true" width="710" height="2048">
        <img class="page-botanical edge-lower" src="{{ asset('images/balance/botanical-edge-v5.webp') }}" alt="" aria-hidden="true" width="710" height="2048" loading="lazy">
        </div>
        <section class="scrap-hero" aria-labelledby="welcome-title">
            <aside class="free-sticker paper-piece"><span class="scrap-tape beige-tape" aria-hidden="true"></span><strong>Gratis meedoen</strong><small>Helemaal op jouw manier.</small></aside>
            <div class="scrap-patch scrap-patch-clay" aria-hidden="true"></div>
            <div class="scrap-patch scrap-patch-sage" aria-hidden="true"></div>
            <div class="scrap-copy">
                <h1 id="welcome-title" class="scrap-title"><span>Lekkerder</span><span>in je vel.</span><span>Op jouw manier.</span></h1>
                <div class="scrap-intro paper-piece"><p>Ik help je zoeken naar jouw balans.<br>Een aanpak op maat, omdat iedereen anders is.<br><strong>Jij zet de stappen. Ik bied je de handvatten.</strong></p><a class="button mustard-button" href="{{ route('register') }}">Vul de vragenlijst in en probeer! <span aria-hidden="true">→</span></a><span class="pencil-rays" aria-hidden="true">⌁</span></div>
                
            </div>
            <div class="scrap-hero-art" aria-hidden="true">
                <img class="walking-cutout" src="{{ asset('images/balance/walking-cutout-v3.webp') }}" width="1120" height="1408" alt="" fetchpriority="high">
                <div class="hero-polaroid paper-piece"><span class="scrap-tape beige-tape"></span><img src="{{ asset('images/balance/salad-v4.webp') }}" width="1254" height="1254" alt=""><span>Goed voor jou.</span></div>
                <div class="hero-note tinted-paper"><span>Jouw leven.<br>Jouw ritme.</span><i aria-hidden="true"></i></div>
            </div>
        </section>
        <section id="inspiratie" class="scrap-card-grid" aria-label="Drie pijlers voor jouw balans">
            <article class="scrap-card paper-piece food-scrap">
                <span class="scrap-tape green-tape" aria-hidden="true"></span>
                <div class="scrap-card-photo"><img src="{{ asset('images/balance/food-v2.webp') }}" width="1536" height="1024" alt="Verse groenten snijden voor een maaltijd" loading="lazy"></div>
                <div class="scrap-card-copy"><h2>Lekker eten</h2><p>Genieten van voedzame, lekkere maaltijden die passen bij jouw leven. Zonder strenge regels.</p>
                    <details><summary>Ontdek meer <span aria-hidden="true">→</span></summary><p>Begin bij iets wat je al lekker vindt. Wat groente bij de lunch, iets voorbereiden voor morgen of rustig samen aan tafel: kies één idee dat jou aanspreekt.</p><a class="text-link" href="{{ route('balance.calendar') }}">Maak er ruimte voor →</a></details>
                    <span class="card-scribble">Goed eten<br>geeft energie.</span><x-balance-leaf class="card-leaf" />
                </div>
            </article>
            <article class="scrap-card paper-piece move-scrap">
                <span class="scrap-tape beige-tape" aria-hidden="true"></span>
                <div class="scrap-card-photo"><img src="{{ asset('images/balance/move-v2.webp') }}" width="1672" height="941" alt="Een man geniet van een wandeling in de natuur" loading="lazy"><span aria-hidden="true" class="photo-sun">☀</span></div>
                <div class="scrap-card-copy"><h2>Fijn bewegen</h2><p>Op een manier die bij jou past. In je eigen ritme, buiten of gewoon thuis.</p>
                    <details><summary>Ontdek meer <span aria-hidden="true">→</span></summary><p>Waar krijg jij plezier van? Een ommetje, zwemmen, dansen in de keuken of sporten met een vriend. Een kleine versie voor een drukke dag mag ook.</p><a class="text-link" href="{{ route('balance.calendar') }}">Plan iets wat bij je past →</a></details>
                    <span class="card-scribble">Buitenlucht<br>doet me goed.</span><svg class="mountain-doodle" viewBox="0 0 100 60" fill="none" aria-hidden="true"><path d="M3 52L28 12L47 43L65 6L96 52M20 26L28 30L34 23M56 22L64 29L73 21M6 57L96 55" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
            </article>
            <article class="scrap-card paper-piece rest-scrap">
                <span class="paperclip" aria-hidden="true"></span>
                <div class="scrap-card-photo"><img src="{{ asset('images/balance/rest-v2.webp') }}" width="1536" height="1024" alt="Een vrouw neemt een rustig moment met een kop thee" loading="lazy"></div>
                <div class="scrap-card-copy"><h2>Rust & zelfliefde</h2><p>Meer ruimte voor wat jou goed doet. Minder moeten, meer mildheid voor jezelf.</p>
                    <details><summary>Ontdek meer <span aria-hidden="true">→</span></summary><p>Je hoeft rust niet te verdienen. Even niets doen, een boek lezen of vriendelijk tegen jezelf praten: ontdek wat op dit moment prettig voelt.</p><a class="text-link" href="{{ route('balance.calendar') }}">Bewaar een moment voor jezelf →</a></details>
                    <span class="card-scribble pink-note tinted-paper">Zorg ook goed<br>voor jezelf.</span>
                </div>
            </article>
        </section>
        <section id="programma" class="program-section" aria-labelledby="program-title">
            <div class="section-paper-heading paper-piece"><span class="eyebrow">Gratis · persoonlijk · samen</span><h2 id="program-title">Jouw balans heeft geen standaardrecept.</h2><p>Afvallen, meer rust of vaker bewegen? Jij kiest je doelen. Ik geef je handvatten om te ontdekken wat werkt voor jóú. Je aanpak mag meeveranderen met je leven.</p></div>
            <div class="program-stickers">
                <article class="program-sticker paper-piece"><span class="step-number">01</span><h3>Jij bent het startpunt.</h3><p>Eten, drinken, bewegen, slaap, stress en zelfliefde: hoe ziet jouw leven er nu uit?</p><span class="sticker-scribble">Eerst begrijpen.</span></article>
                <article class="program-sticker paper-piece"><span class="step-number">02</span><h3>Van plannen naar doen.</h3><p>Kies je startdag en zet één kleine stap. Ervaar wat werkt en pas je ritme steeds een beetje aan. Een kleine versie voor een drukke dag mag ook.</p><span class="sticker-scribble">Gewoon proberen.</span></article>
                <article class="program-sticker paper-piece"><span class="step-number">03</span><h3>Geef je ritme ruimte.</h3><p>Opstarten, pauzes, afschakelen en je dag afsluiten. Ook me-time, we-time en kids-time tellen mee.</p><span class="sticker-scribble">In jouw kalender.</span></article>
                <article class="program-sticker paper-piece"><span class="step-number">04</span><h3>Bijstellen mag.</h3><p>Dagelijks even voelen mag. Wekelijks terugkijken, maandelijks uitzoomen. Gewicht bijhouden? Privé, maximaal één keer per maand.</p><span class="sticker-scribble">Niet alles tegelijk.</span></article>
            </div>
            <div class="program-promise paper-piece"><div><h3>Geen magische formule. Wel handvatten.</h3><p>Jij doet het zelf, maar hoeft het niet alleen te doen. Zelfliefde, ontspanning, affirmaties en meditatie horen er ook bij.</p><p class="program-availability">Begin nu met je eigen kalender. De vragenlijst, doelregistratie en persoonlijke begeleiding volgen.</p></div><a class="button mustard-button" href="{{ route('register') }}">Probeer het uit <span aria-hidden="true">→</span></a></div>
        </section>
        <section id="waarom" class="founder-story founder-journey paper-piece" aria-labelledby="founder-title">
            <div class="founder-journey-heading">
                <span class="eyebrow">Het verhaal achter Jouw Balans</span>
                <h2 id="founder-title">Geen perfect leven.<br>Wel steeds een stapje verder.</h2>
                <p>Ik ben Erik. Vader van drie, vijf dagen aan het werk en een eigen bedrijf ernaast. Ook ik zoek mijn ritme nog.</p>
                <p>Ik herken hoe makkelijk je jezelf voorbijloopt in een maatschappij waarin er altijd iets moet. Werk, gezin, afspraken en steeds bereikbaar zijn: je week is zo gevuld.</p>
                <p>Met Jouw Balans wil ik mensen helpen die ook met die drukte worstelen. Samen zoeken naar meer rust, energie en ruimte voor wat voor jou telt. Met kleine stappen en steun van elkaar.</p>
            </div>
            <figure class="founder-portrait paper-piece">
                <span class="scrap-tape beige-tape" aria-hidden="true"></span>
                <img src="{{ asset('images/balance/erik-family-v11.webp') }}" class="founder-original-photo" width="1535" height="2048" alt="Erik met zijn gezin bij een ijsmeer" loading="lazy">
                <figcaption>Dit is mijn clubje</figcaption>
            </figure>
            <div class="founder-journey-notes">
                <article class="founder-note paper-piece">
                    <span class="scrap-tape beige-tape" aria-hidden="true"></span>
                    <span class="founder-note-number" aria-hidden="true">01</span>
                    <h3>Er is altijd iets</h3>
                    <p>Werk, gezin, zorgen voor elkaar. Maar waar blijf ik zelf? Die vraag herken ik maar al te goed.</p>
                </article>
                <article class="founder-note paper-piece">
                    <span class="scrap-tape beige-tape" aria-hidden="true"></span>
                    <span class="founder-note-number" aria-hidden="true">02</span>
                    <h3>Ik ben gaan proberen</h3>
                    <p>Veel gelezen. Coaching gehad. En ontdekt: plannen helpt, maar ergens moet ik het ook gaan doen. Klein beginnen en ervaren wat werkt.</p>
                </article>
                <article class="founder-note paper-piece">
                    <span class="scrap-tape beige-tape" aria-hidden="true"></span>
                    <span class="founder-note-number" aria-hidden="true">03</span>
                    <h3>Daarom deel ik dit</h3>
                    <p>Ik bouw de handvatten die ik zelf miste. Om samen te zoeken naar een balans die bij jou past. En elkaar onderweg te steunen.</p>
                </article>
            </div>
            <p class="founder-journey-signoff">Nog lang niet uitgeleerd. Wel onderweg. <span>— Erik</span></p>
        </section>
        <section id="samen" class="scrap-community" aria-labelledby="community-title">
            <div class="community-green-sheet" aria-hidden="true"></div>
            <div class="scrap-group-photo paper-piece">
                <span class="scrap-tape beige-tape" aria-hidden="true"></span>
                <img src="{{ asset('images/balance/community-v2.webp') }}" width="1672" height="941" alt="Vier mensen delen thee en een fijn gesprek in de tuin" loading="lazy">
                <span>Samen kom je verder.</span>
            </div>
            <div class="scrap-community-copy">
                <h2 id="community-title">Je hoeft het niet<br>alleen te doen.</h2>
                <p>Een community waar je elkaar positief steunt. Deel wat lukt, vraag om hulp en moedig elkaar aan. Ook als het even niet lekker gaat, ben je welkom.</p>
                <p class="community-welcome-copy">Fanatiek sporter of net begonnen: je bent welkom. Het gaat om je héle balans.</p>
                <a class="button cream-button" href="{{ route('register') }}">Doe gratis mee <span aria-hidden="true">→</span></a>
                <p class="community-availability">De community opent binnenkort. Begin alvast met je eigen kalender.</p>
            </div>
            <aside class="scrap-community-note paper-piece">
                <span class="scrap-tape beige-tape" aria-hidden="true"></span>
                <p><strong>Geen sixpack vereist.</strong></p>
                <p>Jezelf zijn is genoeg.</p>
                <x-balance-leaf />
            </aside>
        </section>
        <section class="example-stories" aria-labelledby="stories-title">
            <div class="section-paper-heading paper-piece"><span class="eyebrow">Kleine veranderingen kunnen veel betekenen</span><h2 id="stories-title">Wat ik hoop dat jij eruit gaat halen en hoe jij het ervaart.</h2></div>
            <div class="story-grid">
                <article class="example-story paper-piece"><img src="{{ asset('images/balance/story-sanne-v5.webp') }}" width="1024" height="1024" alt="Illustratief portret bij het fictieve verhaal van Sanne" loading="lazy"><div><span class="fiction-badge">Voorbeeld</span><h3>Sanne, 38</h3><blockquote>“Mijn pauze hoeft niet meer te wachten tot alles af is.”</blockquote><p>Ze plande één rustig theemoment tussen werk en gezin. Op drukke dagen werd tien minuten er gewoon twee.</p><span class="story-scribble">Een beetje ruimte.</span></div></article>
                <article class="example-story paper-piece"><img src="{{ asset('images/balance/story-mark-v5.webp') }}" width="1024" height="1024" alt="Illustratief portret bij het fictieve verhaal van Mark" loading="lazy"><div><span class="fiction-badge">Voorbeeld</span><h3>Mark, 46</h3><blockquote>“Een ommetje paste beter bij mij dan een groot sportplan.”</blockquote><p>Na de lunch even naar buiten. Geen kilometerdoel, wel iets waar hij plezier in kreeg. Een buurman liep soms gezellig mee.</p><span class="story-scribble">Samen is fijner.</span></div></article>
                <article class="example-story paper-piece"><img src="{{ asset('images/balance/story-nadia-v5.webp') }}" width="1024" height="1024" alt="Illustratief portret bij het fictieve verhaal van Nadia" loading="lazy"><div><span class="fiction-badge">Voorbeeld</span><h3>Nadia, 34</h3><blockquote>“Werk klaar. Nu mag ik weer even thuis zijn.”</blockquote><p>Ze schreef op wat morgen verder mocht, klapte haar laptop dicht en nam een kort moment om af te schakelen.</p><span class="story-scribble">Vandaag is genoeg.</span></div></article>
            </div>
        </section>
        <section class="scrap-calendar-invite paper-piece"><div><span class="eyebrow">Ruimte voor wat telt</span><h2>Klaar voor jouw eerste kleine stap?</h2><p>Gratis meedoen, je eigen momenten kiezen en stap voor stap ontdekken wat bij jou past. Jij bepaalt het tempo.</p></div><a class="button" href="{{ route('register') }}">Ik doe mee <span aria-hidden="true">→</span></a></section>
        <p class="scrap-closing paper-piece">Niet alles tegelijk, wel iets vandaag. </p>
    </div>
</x-layouts.balance>
