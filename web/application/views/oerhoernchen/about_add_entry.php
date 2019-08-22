<?php defined('BASEPATH') or exit('No direct script access allowed');?>

    <div class="container">
        <div class="row">
        	<div class="mx-auto col-lg-9 col-sm-12" style="font-size:18px;">

            <p> Disclaimer: Es handelt sich bei dieser Webseite um einen Prototypen, der „quick & dirty“ erstellt wurde, um die Auffindbarkeit von OER auch praxisbezogen diskutieren zu können.</p>
            <h2>Sie möchten einen OER-Inhalt zu diesem Suchindex hinzufügen?</h2>
            <p style="text-align:justify;">Grundsätzlich sollte man differenzieren: Zum einen gibt es <ul><li>a) bereits hochgeladene Inhalte im Web (z.B. ein YouTube Video), andererseits gibt es </li> <li>b) Inhalte, die noch nicht mit einer URL im Web zugänglich sind, sondern z.B. noch auf Ihrer Festplatte liegen.</li></ul> Letztere müssen also zu erst hochgeladen werden, eh sie erfasst werden können mit Metadaten.<br>Der einfachste Weg wäre, hier direkt ein Formular für den Upload als auch zur Erfassung eines bestehenden Inhalts anzubieten. Die Erfassung habe ich bereits prototypisch implementiert: <a href="<?php echo site_url("lesezeichen/hinzufuegen");?>">Eintrag hinzufügen</a>. Als Einzelperson kann ich aber die Verantwortung für die Redaktion sowie die Haftungsrisiken für mögliche Urheberrechtsfragen nicht tragen, sodass diese Funktion nicht öffentlich aktiviert ist. Daher sind Bundesländerinitiativen sowie Hochschulangebote so immens wichtig für den offenen Austausch von Lehrmaterial: Es geht um Verantwortung und langfristiges Bereitstellen der Inhalte.</p>

              <p>Hier zwei Beispiele, wie die Erfassung von bereits zugänglichen Online-Inhalten in edu-sharing (eingesetzt u.a. in Baden Württemberg bei ZOERR/OERBW) sowie auf dem HOOU-Portal (Hamburg) funktioniert:</p>

              <div class="text-center">
                <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/EcTdY1cLWqA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>

              <div class="text-center">
                <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/5S2shOLrdDQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>



              <p>Je nach Bundeslandzugehörigkeit haben Sie weitere Möglichkeiten - in Zukunft sollen durch OER-Länderinitiativen weitere Möglichkeiten hinzukommen (ggf. existiert an ihrer Hochschule bereits ein OER-Angebot/Repository, diese sind jedoch noch nicht sehr verbreitet). Das große Ziel ist hierbei, dass in allen 16 Bundesländern Hochschulmitarbeiter*innen offenes Lehrmaterial in vielfältigen Formaten veröffentlichen (hochladen) können, welches dann über gute Suchinterfaces einfach und schnell auffindbar ist (dezentrale Vernetzung). Derzeitige Optionen:
            <ul>
              <li><a href="#fueralle">Für alle Wissenschaftler*innen</a></li>
              <li><a href="#bawue" style="color:darkgreen;">Hochschul-Mitarbeiter*innen in Baden Württemberg</a></li>
              <li><a href="#hoou">Hochschul-Mitarbeiter*innen in Hamburg</a></li>
                <li><a href="#rlp">(zukünftig) Hochschul-Mitarbeiter*innen in Rheinland-Pfalz</a></li>
              <li><a href="#nrw">(zukünftig) Hochschul-Mitarbeiter*innen in NRW</a></li>
              <li><a href="#niedersachsen">(zukünftig) Hochschul-Mitarbeiter*innen in Niedersachen</a></li>
                <li><a href="#hessen">(zukünftig) Hochschul-Mitarbeiter*innen in Hessen</a></li>
                <li><a href="#oesterreich">Hochschulmitarbeiter*in in Österreich</a></li>
            </ul>
          </p>

            <h2 id="fueralle">Für alle Wissenschaftler*innen</h2>

              <p>Generell haben Sie, unabhängig vom Bundesland und ob Sie derzeit im Anstellungsverhältnis an einer Hochschule sind, folgende Optionen: Für Dokumente und Präsentationen bietet sich <a href="https://zenodo.org">Zenodo</a> an, für wissenschaftliche Videos das <a href="https://av.tib.eu/">TIB AV Portal</a>, interaktive h5p-Inhalte können erstmal auf der Demo-Instanz <a href="https://h5p.org/">h5p.org</a> veröffentlicht werden und statische Webseiten können auf <a href="https://gitlab.com">Gitlab.com</a> (GitLab Pages) gehostet werden. Falls Sie am Thema MOOC-Erstellung interessiert sind, bietet oncampus ein offenes Angebot <a href="https://www.oncampus.de/weiterbildung/moocs/mooin-maker">(MOOC Maker)</a> an.</p>


            <h2 id="bawue" style="color:darkgreen;">Baden Württemberg</h2>
</
            <p>Dank des Teams an der Uni Tübingen (Peter Rempis, Michael Menzel und weitere hochengagierte Mitarbeiter*innen) sowie des <a href="https://mwk.baden-wuerttemberg.de/de/startseite/">MWK BaWü</a> sind Sie als Hochschulmitarbeiter*in in der glücklichen Lage, als derzeit einziges Bundesland ihre OER-Inhalte bereits hochladen und indexieren zu können mittels einer Web-Oberfläche.<br>Melden Sie sich in der <a href="https://www.oerbw.de/edu-sharing/components/search?mainnav=true">ZOERR-Weboberfläche</a> einfach mit Ihrem Uni-Login an:</p>

            <img src="<?php echo base_url();?>/assets/img/zoerr_login.png" style="max-width:100%;"/>

            <img src="<?php echo base_url();?>/assets/img/zoerr_login_2.png" style="max-width:100%;"/>

            <p>Danach können Sie Inhalte hochladen und einreichen (<a href="http://hdl.handle.net/10900.3/OER_pkRwAPIQ">Video-Anleitung</a>)</p>

            <div class="text-center">
              <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/SHB7Tpc8UAc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
          <p>Ebenfalls ist das Hinzufügen eines Inhalts möglich, der bereits ins Web hochgeladen wurde:</p>
          <div class="text-center">
            <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/5S2shOLrdDQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>


            <h2 id="hoou">Hamburg (Förderprojekte)</h2>

              <p>Auf dem Portal der <a href="https://www.hoou.de/">HOOU</a> (Hamburg Open Online University) stellen derzeit die HOOU-Förderprojekte ihr Material ein. Ob das Portal für alle Lehrenden geöffnet wird, kann ich derzeit nicht einschätzen - als engagierter Lehrende/r oder wissenschaftliche Mitarbeiter/innen können sie aber sicher jederzeit mal beim <a href="https://www.hoou.de/p/kontakt/">HOOU-Team</a> anklopfen und Ihr Interesse signalisieren.</p>

              <div class="text-center">
                <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/EcTdY1cLWqA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>

              <p>Tolle Sache: Auch externe Personen können HOOU-Projektförderungen erhalten, siehe Infos <a href="https://www.hoou.de/blog/foerdermoeglichkeiten-fuer-hoou-kooperationsprojekte">hier</a>

              <p>Als Mitarbeiter*in der Uni Hamburg haben Sie derzeit einen kleinen Wettbewerbsvorteil: Da die Uni Hamburg sich via DFN-AAI mit OERBW verbunden hat, können auch Sie über die obige Baden-Württemberg-Weboberfläche Inhalte hinzufügen.</p>

              <h2 id="rlp">(zukünftig) Rheinland-Pfalz</h2>
                <p>In Rheinland-Pfalz arbeiten engagierte Menschen bereits seit längerer Zeit am offenen Austausch von Lehrmaterial, siehe z.B. <a href="https://www.oer-at-rlp.de">OER@RLP</a>. Eine Veröffentlichungsmöglichkeit ist derzeit in der Beta-Phase, bei Fragen kann man sich vertrauensvoll ans <a href="https://www.vcrp.de/">VCRP</a> wenden.

            <h2 id="nrw">(zukünftig) NRW</h2>
              <p>In NRW laufen derzeit Vorprojekte, ein Portal als auch dezentrale Lösungen für die bestehende Hochschulinfrastruktur (LMS,Repositorien) sind im Gespräch: <a href="http://heureka.blogs.ruhr-uni-bochum.de">Projektblog und Infos</a> (Danke an dieser Stelle an <a href="https://www.mkw.nrw/">MKW NRW</a> + alle aktiven Akteure im <a href="https://www.dh-nrw.de/">DH-NRW-Netzwerk</a>)</p>

              <p>Eine Liste von bereits aktiven OER-Projekten in NRW findet sich <a href="https://heureka.blogs.ruhr-uni-bochum.de/workshop-oernrw-oer-projekte-an-hochschulen-in-nrw-09-07-2019/">hier</a></p>

              <p>Aktuelle Info: Bis 30. November 2019 bewerben: <a href="https://www.mkw.nrw/foerderlinien-digitalisierungsoffensive">Content-Förderlinie OERcontentNRW sowie Förderlinie „Netzwerk Landesportal DH-NRW“ (OER-Bezug)</a></p>

              <p>Als Mitarbeiter*in der Uni Köln haben Sie derzeit einen kleinen Wettbewerbsvorteil: Da die Uni Köln sich via DFN-AAI bereits mit OERBW verbunden hat, können auch Sie über die obige Baden-Württemberg-Weboberfläche Inhalte hinzufügen.</p>

            <h2 id="niedersachsen">(zukünftig) Niedersachsen</h2>
              <p>In Niedersachen startet in Kürze das Projekt „Open Educational Resources (OER) Portal Niedersachsen“, beteiligt ist u.a. die TIB.</p>

              <h2 id="nrw">(zukünftig) Hessen</h2>
                <p>Auch in Hessen beschäftigt man sich mit OER, siehe <a href="https://www.digll-hessen.de/de">Digital gestütztes Lehren und Lernen in Hessen</a></p>

                <h2 id="oesterreich">Österreich</h2>

                <p><a href="https://www.openeducation.at/home/">https://www.openeducation.at/home/</a></p>

                <h2>Bundesland/Land fehlt?</h2>

              <p>Bundesland fehlt? >> info ((at)) matthias-andrasch.de oder <a href="https://twitter.com/m_andrasch">Twitter-DM</a></p>

              <h2>Über den deutschsprachigen Tellerrand hinaus:</h2>

              <p>Englischssprachige OER-Suche (USA): <a href="https://oasis.geneseo.edu/">OASIS</a> (SUNY Geneseo's Milne Library, New York)</p>

              <h3>Lizenz dieses Textes</h3>
              <div class="oer-cc-licensebox"><a href="https://creativecommons.org/publicdomain/zero/1.0/deed.de"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiID8+PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEgQmFzaWMvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEtYmFzaWMuZHRkIj48c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHdpZHRoPSI4OCIgaGVpZ2h0PSIzMSIgdmlld0JveD0iMCAwIDg4IDMxIiBiYXNlUHJvZmlsZT0iYmFzaWMiIHZlcnNpb249IjEuMSI+PGcgaWQ9InN1cmZhY2UxIj48cGF0aCBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDY2LjY2NjY2NyUsNjkuODAzOTIyJSw2Ny4wNTg4MjQlKTtmaWxsLW9wYWNpdHk6MTsiIGQ9Ik0gMi4zMDA3ODEgMC41NzAzMTMgTCA4NS40Mjk2ODggMC43MTg3NSBDIDg2LjU4OTg0NCAwLjcxODc1IDg3LjYyODkwNiAwLjU0Njg3NSA4Ny42Mjg5MDYgMy4wMzkwNjMgTCA4Ny41MjczNDQgMzAuNDE0MDYzIEwgMC4yMDMxMjUgMzAuNDE0MDYzIEwgMC4yMDMxMjUgMi45Mzc1IEMgMC4yMDMxMjUgMS43MDcwMzEgMC4zMjQyMTkgMC41NzAzMTMgMi4zMDA3ODEgMC41NzAzMTMgWiAiLz48cGF0aCBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDAlLDAlLDAlKTtmaWxsLW9wYWNpdHk6MTsiIGQ9Ik0gODYuMzUxNTYzIDAuMTk5MjE5IEwgMS42NDg0MzggMC4xOTkyMTkgQyAwLjczODI4MSAwLjE5OTIxOSAwIDAuOTM3NSAwIDEuODQ3NjU2IEwgMCAzMC42Mjg5MDYgQyAwIDMwLjgzMjAzMSAwLjE2Nzk2OSAzMSAwLjM3MTA5NCAzMSBMIDg3LjYyODkwNiAzMSBDIDg3LjgzMjAzMSAzMSA4OCAzMC44MzIwMzEgODggMzAuNjI4OTA2IEwgODggMS44NDc2NTYgQyA4OCAwLjkzNzUgODcuMjYxNzE5IDAuMTk5MjE5IDg2LjM1MTU2MyAwLjE5OTIxOSBaIE0gMS42NDg0MzggMC45NDUzMTMgTCA4Ni4zNTE1NjMgMC45NDUzMTMgQyA4Ni44NTE1NjMgMC45NDUzMTMgODcuMjUzOTA2IDEuMzQ3NjU2IDg3LjI1MzkwNiAxLjg0NzY1NiBDIDg3LjI1MzkwNiAxLjg0NzY1NiA4Ny4yNTM5MDYgMTMuNDY4NzUgODcuMjUzOTA2IDIxLjg1MTU2MyBMIDI2LjUxNTYyNSAyMS44NTE1NjMgQyAyNC4yOTY4NzUgMjUuODYzMjgxIDIwLjAyMzQzOCAyOC41ODU5MzggMTUuMTE3MTg4IDI4LjU4NTkzOCBDIDEwLjIwNzAzMSAyOC41ODU5MzggNS45MzM1OTQgMjUuODYzMjgxIDMuNzE0ODQ0IDIxLjg1MTU2MyBMIDAuNzQ2MDk0IDIxLjg1MTU2MyBDIDAuNzQ2MDk0IDEzLjQ2ODc1IDAuNzQ2MDk0IDEuODQ3NjU2IDAuNzQ2MDk0IDEuODQ3NjU2IEMgMC43NDYwOTQgMS4zNDc2NTYgMS4xNDg0MzggMC45NDUzMTMgMS42NDg0MzggMC45NDUzMTMgWiAiLz48cGF0aCBzdHlsZT0iIHN0cm9rZTpub25lO2ZpbGwtcnVsZTpub256ZXJvO2ZpbGw6cmdiKDEwMCUsMTAwJSwxMDAlKTtmaWxsLW9wYWNpdHk6MTsiIGQ9Ik0gNDYuNzUzOTA2IDIzLjk4NDM3NSBMIDUwLjgzMjAzMSAyMy45ODQzNzUgTCA1MC44MzIwMzEgMjQuNzM4MjgxIEwgNDguMjMwNDY5IDI3Ljg4NjcxOSBMIDUwLjkwNjI1IDI3Ljg4NjcxOSBMIDUwLjkwNjI1IDI4LjgzMjAzMSBMIDQ2LjY3OTY4OCAyOC44MzIwMzEgTCA0Ni42Nzk2ODggMjguMDc0MjE5IEwgNDkuMjgxMjUgMjQuOTI1NzgxIEwgNDYuNzUzOTA2IDI0LjkyNTc4MSBMIDQ2Ljc1MzkwNiAyMy45ODQzNzUgTSA1MS44MTI1IDIzLjk4NDM3NSBMIDU1LjE4MzU5NCAyMy45ODQzNzUgTCA1NS4xODM1OTQgMjQuOTI1NzgxIEwgNTMuMDYyNSAyNC45MjU3ODEgTCA1My4wNjI1IDI1LjgzMjAzMSBMIDU1LjA1ODU5NCAyNS44MzIwMzEgTCA1NS4wNTg1OTQgMjYuNzczNDM4IEwgNTMuMDYyNSAyNi43NzM0MzggTCA1My4wNjI1IDI3Ljg4NjcxOSBMIDU1LjI1MzkwNiAyNy44ODY3MTkgTCA1NS4yNTM5MDYgMjguODMyMDMxIEwgNTEuODEyNSAyOC44MzIwMzEgTCA1MS44MTI1IDIzLjk4NDM3NSBNIDU4LjEzMjgxMyAyNi4xMzI4MTMgQyA1OC4zOTQ1MzEgMjYuMTMyODEzIDU4LjU4MjAzMSAyNi4wODIwMzEgNTguNjk1MzEzIDI1Ljk4NDM3NSBDIDU4LjgwODU5NCAyNS44OTA2MjUgNTguODY3MTg4IDI1LjczMDQ2OSA1OC44NjcxODggMjUuNTAzOTA2IEMgNTguODY3MTg4IDI1LjI4NTE1NiA1OC44MDg1OTQgMjUuMTI1IDU4LjY5NTMxMyAyNS4wMzEyNSBDIDU4LjU4MjAzMSAyNC45Mzc1IDU4LjM5NDUzMSAyNC44OTA2MjUgNTguMTMyODEzIDI0Ljg5MDYyNSBMIDU3LjYwNTQ2OSAyNC44OTA2MjUgTCA1Ny42MDU0NjkgMjYuMTMyODEzIEwgNTguMTMyODEzIDI2LjEzMjgxMyBNIDU3LjYwNTQ2OSAyNi45OTYwOTQgTCA1Ny42MDU0NjkgMjguODMyMDMxIEwgNTYuMzU1NDY5IDI4LjgzMjAzMSBMIDU2LjM1NTQ2OSAyMy45ODQzNzUgTCA1OC4yNjU2MjUgMjMuOTg0Mzc1IEMgNTguOTAyMzQ0IDIzLjk4NDM3NSA1OS4zNzEwOTQgMjQuMDg5ODQ0IDU5LjY2Nzk2OSAyNC4zMDQ2ODggQyA1OS45NjQ4NDQgMjQuNTE5NTMxIDYwLjExNzE4OCAyNC44NTU0NjkgNjAuMTE3MTg4IDI1LjMyMDMxMyBDIDYwLjExNzE4OCAyNS42NDA2MjUgNjAuMDM5MDYzIDI1LjkwMjM0NCA1OS44ODI4MTMgMjYuMTA5Mzc1IEMgNTkuNzMwNDY5IDI2LjMxNjQwNiA1OS40OTYwOTQgMjYuNDY0ODQ0IDU5LjE4MzU5NCAyNi41NjI1IEMgNTkuMzU1NDY5IDI2LjYwMTU2MyA1OS41MDc4MTMgMjYuNjkxNDA2IDU5LjY0MDYyNSAyNi44MzIwMzEgQyA1OS43NzczNDQgMjYuOTY0ODQ0IDU5LjkxNDA2MyAyNy4xNzU3ODEgNjAuMDU0Njg4IDI3LjQ1MzEyNSBMIDYwLjczNDM3NSAyOC44MzIwMzEgTCA1OS40MDIzNDQgMjguODMyMDMxIEwgNTguODEyNSAyNy42MjUgQyA1OC42OTE0MDYgMjcuMzgyODEzIDU4LjU3MDMxMyAyNy4yMTg3NSA1OC40NDUzMTMgMjcuMTI4OTA2IEMgNTguMzI0MjE5IDI3LjAzOTA2MyA1OC4xNjQwNjMgMjYuOTk2MDk0IDU3Ljk2MDkzOCAyNi45OTYwOTQgTCA1Ny42MDU0NjkgMjYuOTk2MDk0IE0gNjMuNjg3NSAyNC44MDA3ODEgQyA2My4zMDQ2ODggMjQuODAwNzgxIDYzLjAxMTcxOSAyNC45NDE0MDYgNjIuODAwNzgxIDI1LjIyMjY1NiBDIDYyLjU4OTg0NCAyNS41MDM5MDYgNjIuNDg0Mzc1IDI1LjkwMjM0NCA2Mi40ODQzNzUgMjYuNDEwMTU2IEMgNjIuNDg0Mzc1IDI2LjkyMTg3NSA2Mi41ODk4NDQgMjcuMzE2NDA2IDYyLjgwMDc4MSAyNy41OTc2NTYgQyA2My4wMTE3MTkgMjcuODc4OTA2IDYzLjMwNDY4OCAyOC4wMTk1MzEgNjMuNjg3NSAyOC4wMTk1MzEgQyA2NC4wNzAzMTMgMjguMDE5NTMxIDY0LjM2NzE4OCAyNy44Nzg5MDYgNjQuNTc4MTI1IDI3LjU5NzY1NiBDIDY0Ljc4NTE1NiAyNy4zMTY0MDYgNjQuODkwNjI1IDI2LjkyMTg3NSA2NC44OTA2MjUgMjYuNDEwMTU2IEMgNjQuODkwNjI1IDI1LjkwMjM0NCA2NC43ODUxNTYgMjUuNTAzOTA2IDY0LjU3ODEyNSAyNS4yMjI2NTYgQyA2NC4zNjcxODggMjQuOTQxNDA2IDY0LjA3MDMxMyAyNC44MDA3ODEgNjMuNjg3NSAyNC44MDA3ODEgTSA2My42ODc1IDIzLjg5NDUzMSBDIDY0LjQ2NDg0NCAyMy44OTQ1MzEgNjUuMDc4MTI1IDI0LjExNzE4OCA2NS41MTk1MzEgMjQuNTYyNSBDIDY1Ljk2MDkzOCAyNS4wMTE3MTkgNjYuMTc5Njg4IDI1LjYyNSA2Ni4xNzk2ODggMjYuNDEwMTU2IEMgNjYuMTc5Njg4IDI3LjE5NTMxMyA2NS45NjA5MzggMjcuODA4NTk0IDY1LjUxOTUzMSAyOC4yNTM5MDYgQyA2NS4wNzgxMjUgMjguNzAzMTI1IDY0LjQ2NDg0NCAyOC45MjU3ODEgNjMuNjg3NSAyOC45MjU3ODEgQyA2Mi45MTAxNTYgMjguOTI1NzgxIDYyLjMwMDc4MSAyOC43MDMxMjUgNjEuODU1NDY5IDI4LjI1MzkwNiBDIDYxLjQxNDA2MyAyNy44MDg1OTQgNjEuMTk1MzEzIDI3LjE5NTMxMyA2MS4xOTUzMTMgMjYuNDEwMTU2IEMgNjEuMTk1MzEzIDI1LjYyNSA2MS40MTQwNjMgMjUuMDExNzE5IDYxLjg1NTQ2OSAyNC41NjI1IEMgNjIuMzAwNzgxIDI0LjExNzE4OCA2Mi45MTAxNTYgMjMuODk0NTMxIDYzLjY4NzUgMjMuODk0NTMxICIvPjxwYXRoIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoMTAwJSwxMDAlLDEwMCUpO2ZpbGwtb3BhY2l0eToxOyIgZD0iTSAyNS4xMjEwOTQgMTQuNTc4MTI1IEMgMjUuMTI1IDIwLjA5NzY1NiAyMC42NDg0MzggMjQuNTc4MTI1IDE1LjEyNSAyNC41ODIwMzEgQyA5LjYwNTQ2OSAyNC41ODU5MzggNS4xMjUgMjAuMTEzMjgxIDUuMTIxMDk0IDE0LjU4OTg0NCBDIDUuMTIxMDk0IDE0LjU4NTkzOCA1LjEyMTA5NCAxNC41ODIwMzEgNS4xMjEwOTQgMTQuNTc4MTI1IEMgNS4xMTcxODggOS4wNTQ2ODggOS41OTM3NSA0LjU3ODEyNSAxNS4xMTMyODEgNC41NzQyMTkgQyAyMC42MzY3MTkgNC41NzAzMTMgMjUuMTE3MTg4IDkuMDQyOTY5IDI1LjEyMTA5NCAxNC41NjY0MDYgQyAyNS4xMjEwOTQgMTQuNTcwMzEzIDI1LjEyMTA5NCAxNC41NzQyMTkgMjUuMTIxMDk0IDE0LjU3ODEyNSBaICIvPjxwYXRoIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoMCUsMCUsMCUpO2ZpbGwtb3BhY2l0eToxOyIgZD0iTSAyMy4yNSA2LjQzMzU5NCBDIDI1LjQ2NDg0NCA4LjY1MjM0NCAyNi41NzQyMTkgMTEuMzY3MTg4IDI2LjU3NDIxOSAxNC41NzgxMjUgQyAyNi41NzQyMTkgMTcuNzg5MDYzIDI1LjQ4NDM3NSAyMC40NzY1NjMgMjMuMzA0Njg4IDIyLjYzNjcxOSBDIDIwLjk5MjE4OCAyNC45MTAxNTYgMTguMjYxNzE5IDI2LjA0Njg3NSAxNS4xMDU0NjkgMjYuMDQ2ODc1IEMgMTEuOTkyMTg4IDI2LjA0Njg3NSA5LjMwNDY4OCAyNC45MjE4NzUgNy4wNTA3ODEgMjIuNjY0MDYzIEMgNC43OTI5NjkgMjAuNDEwMTU2IDMuNjY3OTY5IDE3LjcxNDg0NCAzLjY2Nzk2OSAxNC41NzgxMjUgQyAzLjY2Nzk2OSAxMS40NDE0MDYgNC43OTI5NjkgOC43MjY1NjMgNy4wNTA3ODEgNi40MzM1OTQgQyA5LjI0NjA5NCA0LjIxNDg0NCAxMS45MzM1OTQgMy4xMDkzNzUgMTUuMTA1NDY5IDMuMTA5Mzc1IEMgMTguMzE2NDA2IDMuMTA5Mzc1IDIxLjAzMTI1IDQuMjE0ODQ0IDIzLjI1IDYuNDMzNTk0IFogTSA4LjU0Mjk2OSA3LjkyNTc4MSBDIDYuNjY3OTY5IDkuODIwMzEzIDUuNzMwNDY5IDEyLjAzNTE1NiA1LjczMDQ2OSAxNC41ODIwMzEgQyA1LjczMDQ2OSAxNy4xMjUgNi42NjAxNTYgMTkuMzI0MjE5IDguNTExNzE5IDIxLjE3NTc4MSBDIDEwLjM2NzE4OCAyMy4wMzEyNSAxMi41NzgxMjUgMjMuOTYwOTM4IDE1LjE0MDYyNSAyMy45NjA5MzggQyAxNy43MDMxMjUgMjMuOTYwOTM4IDE5LjkyOTY4OCAyMy4wMjM0MzggMjEuODI0MjE5IDIxLjE0ODQzOCBDIDIzLjYyMTA5NCAxOS40MTAxNTYgMjQuNTE5NTMxIDE3LjIxODc1IDI0LjUxOTUzMSAxNC41ODIwMzEgQyAyNC41MTk1MzEgMTEuOTYwOTM4IDIzLjYwNTQ2OSA5LjczODI4MSAyMS43ODEyNSA3LjkxMDE1NiBDIDE5Ljk1MzEyNSA2LjA4NTkzOCAxNy43NDIxODggNS4xNzE4NzUgMTUuMTQwNjI1IDUuMTcxODc1IEMgMTIuNTM5MDYzIDUuMTcxODc1IDEwLjMzOTg0NCA2LjA4OTg0NCA4LjU0Mjk2OSA3LjkyNTc4MSBaIE0gMTMuNDc2NTYzIDEzLjQ2MDkzOCBDIDEzLjE4NzUgMTIuODM1OTM4IDEyLjc2MTcxOSAxMi41MjM0MzggMTIuMTg3NSAxMi41MjM0MzggQyAxMS4xNzU3ODEgMTIuNTIzNDM4IDEwLjY3MTg3NSAxMy4yMDcwMzEgMTAuNjcxODc1IDE0LjU2NjQwNiBDIDEwLjY3MTg3NSAxNS45MjU3ODEgMTEuMTc1NzgxIDE2LjYwNTQ2OSAxMi4xODc1IDE2LjYwNTQ2OSBDIDEyLjg1NTQ2OSAxNi42MDU0NjkgMTMuMzMyMDMxIDE2LjI3NzM0NCAxMy42MTcxODggMTUuNjEzMjgxIEwgMTUuMDE5NTMxIDE2LjM1OTM3NSBDIDE0LjM1MTU2MyAxNy41NDI5NjkgMTMuMzUxNTYzIDE4LjEzNjcxOSAxMi4wMTU2MjUgMTguMTM2NzE5IEMgMTAuOTg0Mzc1IDE4LjEzNjcxOSAxMC4xNTYyNSAxNy44MjQyMTkgOS41MzkwNjMgMTcuMTkxNDA2IEMgOC45MTc5NjkgMTYuNTU4NTk0IDguNjA5Mzc1IDE1LjY4NzUgOC42MDkzNzUgMTQuNTc4MTI1IEMgOC42MDkzNzUgMTMuNDg4MjgxIDguOTI1NzgxIDEyLjYyMTA5NCA5LjU2NjQwNiAxMS45ODA0NjkgQyAxMC4yMDcwMzEgMTEuMzM1OTM4IDExLjAwMzkwNiAxMS4wMTU2MjUgMTEuOTU3MDMxIDExLjAxNTYyNSBDIDEzLjM3MTA5NCAxMS4wMTU2MjUgMTQuMzc4OTA2IDExLjU3NDIxOSAxNC45OTIxODggMTIuNjg3NSBaIE0gMjAuMDY2NDA2IDEzLjQ2MDkzOCBDIDE5Ljc4MTI1IDEyLjgzNTkzOCAxOS4zNTkzNzUgMTIuNTIzNDM4IDE4LjgwODU5NCAxMi41MjM0MzggQyAxNy43NzczNDQgMTIuNTIzNDM4IDE3LjI2MTcxOSAxMy4yMDcwMzEgMTcuMjYxNzE5IDE0LjU2NjQwNiBDIDE3LjI2MTcxOSAxNS45MjU3ODEgMTcuNzc3MzQ0IDE2LjYwNTQ2OSAxOC44MDg1OTQgMTYuNjA1NDY5IEMgMTkuNDc2NTYzIDE2LjYwNTQ2OSAxOS45NDUzMTMgMTYuMjc3MzQ0IDIwLjIxMDkzOCAxNS42MTMyODEgTCAyMS42NDQ1MzEgMTYuMzU5Mzc1IEMgMjAuOTc2NTYzIDE3LjU0Mjk2OSAxOS45NzY1NjMgMTguMTM2NzE5IDE4LjY0NDUzMSAxOC4xMzY3MTkgQyAxNy42MTMyODEgMTguMTM2NzE5IDE2Ljc4OTA2MyAxNy44MjQyMTkgMTYuMTcxODc1IDE3LjE5MTQwNiBDIDE1LjU1MDc4MSAxNi41NTg1OTQgMTUuMjQyMTg4IDE1LjY4NzUgMTUuMjQyMTg4IDE0LjU3ODEyNSBDIDE1LjI0MjE4OCAxMy40ODgyODEgMTUuNTU0Njg4IDEyLjYyMTA5NCAxNi4xODM1OTQgMTEuOTgwNDY5IEMgMTYuODEyNSAxMS4zMzU5MzggMTcuNjEzMjgxIDExLjAxNTYyNSAxOC41ODU5MzggMTEuMDE1NjI1IEMgMTkuOTk2MDk0IDExLjAxNTYyNSAyMS4wMDM5MDYgMTEuNTc0MjE5IDIxLjYxMzI4MSAxMi42ODc1IFogIi8+PHBhdGggc3R5bGU9IiBzdHJva2U6bm9uZTtmaWxsLXJ1bGU6bm9uemVybztmaWxsOnJnYigxMDAlLDEwMCUsMTAwJSk7ZmlsbC1vcGFjaXR5OjE7IiBkPSJNIDYwLjAzMTI1IDEwLjg3ODkwNiBDIDYwLjAzMTI1IDE1LjEyODkwNiA1OC4zMDg1OTQgMTguNTc4MTI1IDU2LjE4MzU5NCAxOC41NzgxMjUgQyA1NC4wNTQ2ODggMTguNTc4MTI1IDUyLjMzMjAzMSAxNS4xMjg5MDYgNTIuMzMyMDMxIDEwLjg3ODkwNiBDIDUyLjMzMjAzMSA2LjYyNSA1NC4wNTQ2ODggMy4xNzk2ODggNTYuMTgzNTk0IDMuMTc5Njg4IEMgNTguMzA4NTk0IDMuMTc5Njg4IDYwLjAzMTI1IDYuNjI1IDYwLjAzMTI1IDEwLjg3ODkwNiBaICIvPjxwYXRoIHN0eWxlPSIgc3Ryb2tlOm5vbmU7ZmlsbC1ydWxlOm5vbnplcm87ZmlsbDpyZ2IoMCUsMCUsMCUpO2ZpbGwtb3BhY2l0eToxOyIgZD0iTSA1Ni40Mjk2ODggMi40MTc5NjkgQyA1MS41ODIwMzEgMi40MTc5NjkgNTAuMzU5Mzc1IDYuOTk2MDk0IDUwLjM1OTM3NSAxMC44NzUgQyA1MC4zNTkzNzUgMTQuNzU3ODEzIDUxLjU4MjAzMSAxOS4zMzIwMzEgNTYuNDI5Njg4IDE5LjMzMjAzMSBDIDYxLjI4MTI1IDE5LjMzMjAzMSA2Mi41IDE0Ljc1NzgxMyA2Mi41IDEwLjg3NSBDIDYyLjUgNi45OTYwOTQgNjEuMjgxMjUgMi40MTc5NjkgNTYuNDI5Njg4IDIuNDE3OTY5IFogTSA1Ni40Mjk2ODggNS42MDkzNzUgQyA1Ni42Mjg5MDYgNS42MDkzNzUgNTYuODA4NTk0IDUuNjM2NzE5IDU2Ljk3NjU2MyA1LjY3OTY4OCBDIDU3LjMyNDIxOSA1Ljk4MDQ2OSA1Ny40OTYwOTQgNi4zOTQ1MzEgNTcuMTYwMTU2IDYuOTc2NTYzIEwgNTMuOTI5Njg4IDEyLjkxNDA2MyBDIDUzLjgzMjAzMSAxMi4xNjAxNTYgNTMuODE2NDA2IDExLjQyNTc4MSA1My44MTY0MDYgMTAuODc1IEMgNTMuODE2NDA2IDkuMTY3OTY5IDUzLjkzNzUgNS42MDkzNzUgNTYuNDI5Njg4IDUuNjA5Mzc1IFogTSA1OC44NDc2NTYgOC4zNDM3NSBDIDU5LjAxOTUzMSA5LjI1NzgxMyA1OS4wNDI5NjkgMTAuMjA3MDMxIDU5LjA0Mjk2OSAxMC44NzUgQyA1OS4wNDI5NjkgMTIuNTg1OTM4IDU4LjkyNTc4MSAxNi4xNDQ1MzEgNTYuNDI5Njg4IDE2LjE0NDUzMSBDIDU2LjIzNDM3NSAxNi4xNDQ1MzEgNTYuMDU0Njg4IDE2LjEyNSA1NS44ODY3MTkgMTYuMDgyMDMxIEMgNTUuODUxNTYzIDE2LjA3NDIxOSA1NS44MjQyMTkgMTYuMDYyNSA1NS43OTI5NjkgMTYuMDUwNzgxIEMgNTUuNzQyMTg4IDE2LjAzNTE1NiA1NS42ODc1IDE2LjAxOTUzMSA1NS42NDA2MjUgMTYgQyA1NS4wODIwMzEgMTUuNzY1NjI1IDU0LjczNDM3NSAxNS4zMzU5MzggNTUuMjM4MjgxIDE0LjU4MjAzMSBaICIvPjwvZz48L3N2Zz4=" alt="CC0/Public Domain"></a><br>Weiternutzung als OER ausdrücklich erlaubt: Für dieses Werk wird kein urheberrechtlicher Schutz beansprucht, Freigabe unter <a href="https://creativecommons.org/publicdomain/zero/1.0/deed.de" rel="license" target="_blank">CC0/Public Domain</a>. Optionaler Hinweis gemäß <a href="https://open-educational-resources.de/oer-tullu-regel/">TULLU-Regel</a>: <i> <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Matthias Andrasch</span>, freigegeben als: <a href="https://creativecommons.org/publicdomain/zero/1.0/deed.de" target="_blank">CC0/Public Domain</a></i>. Ausgenommen sind Videoinhalte und externe Grafiken.</div>
			    </div>
		</div>
	</div>
