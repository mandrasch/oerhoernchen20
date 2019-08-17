<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

    <div class="container">
        <div class="row">
        	<div class="mx-auto col-lg-9 col-sm-12">

                <h2>Prototyp ausprobieren</h2>

                <p><a href="<?php echo site_url('lesezeichen/') . '?licenseTypeFilter=' . urlencode('["CC0","CC BY","CC BY-SA"]'); ?>">Community-Lesezeichen durchsuchen</a> | <a href="<?php echo site_url('lesezeichen/hinzufuegen/'); ?>">Lesezeichen eintragen</a></p>

                <h2>About</h2>

        		<p>Dieses Projekt soll eine mögliche Weiterentwicklung von Social-Bookmarking-Ansätzen wie <a href="https://www.edutags.de/" target="_blank">edutags</a> aufzeigen. Der Prototyp ist explizit für Open Educational Resources gedacht und basiert u.a. auf diesen Annahmen:

                    <ul>
                        <li>Es reicht nicht aus, User*innen das freie Verschlagworten anzubieten als Funktion. Für die zielführende, gemeinsame Erfassung von Material im Web braucht es eine gewisse Vorstrukturierung. Daher setzt dieser Prototyp auf einen Metadaten-ähnlichen Erfassungseditor, welcher möglichst intuitiv verständlich für Nutzer*innen aus dem Bildungskontext sein soll.</li>
                        <li>Didaktisch-gestaltete OER sollten möglichst als Einheit (Module) zur Verfügung gestellt und über eine URL erfasst werden, während Einzelinhalte (eher Open Content) für die Mediengestaltung ebenfalls eine gewichtige Rolle spielen, aber andere Ansätze für die Auffindbarkeit benötigen (Bspw. Fotos, Icons, Präsentationsdesigns, etc.)</li>
                        <li>Über den HTML-Quelltext lassen sich vielfach bereits Informationen automatisiert (Stichwort: Maschinenlesbarkeit) auslesen, daher bietet der Prototyp einen "Analyse"-Button im URL-Feld an. Die ausgelesenen Informationen können nach der Analyse von den Nutzer*innen verfeinert werden.</li>
                        <li>Metadaten für OER sind aktuell teils irritierend und erfassen zum Teil aktuelle Trends nicht nutzerorientiert. Daher wurde in diesem Prototypen bspw. prominent das Format "h5p" an erster Stelle des Filters gesetzt sowie vorerst ein erste, abgespeckte Kategorisierung gewählt.</li>
                        <li>Eine potenziell wichtige Infrastruktur wie edutags (oder auch Elixier) sollte zukünftig möglichst als Open-Source in Community-Kontrolle sein, um neue Funktionen ergänzen zu können bzw. damit experimentieren zu können.</li>
                        <li>Es existiert weiterhin das Potenzial im deutschsprachigen Raum, OERs gemeinsam und manuell zu erfassen (neben den Bemühungene einer automatisierten Vernetzung von Inhaltsquellen/Repositories)</li>
                    </ul>
                </p>

                <p>Dieser Prototyp ist ein erste Version, die ich in meiner Freizeit entwickelt habe.



                , welche insbesondere auf Open Educational Resources zugeschnitten ist. Ziel soll es sein, gemeinsam gute OER-Werke aus dem World Wide Web schnell und unkompliziert zu erfassen. Also z.B. Youtube-Videos mit der korrekten Lizenz zu erfassen als auch h5p-Inhalte zu indexieren.</p>

        		<p>Es handelt sich hierbei um ein weiteres "Platzhalter-Projekt", aus welchem ggf. eine professionellere Lösung entstehen könnte. Technisch wurde auf den Elastic-Search-Dienstleister <a href="https://appbase.io/">Appbase.io</a> zurückgegriffen. Ggf. wird <a href="https://blog.moodle.net/" target="_blank">MoodleNet</a> die hier gezeigten Funktionen in Zukunft ebenfalls anbieten. Außerdem wird durch <a href="http://blog.lobid.org/2019/05/17/skohub.html" target="_blank">SkoHub</a> in Zukunft ebenfalls ein dezentraler Metadaten-Editor entstehen.</p>

        		<p>Da für ein öffentliches Betreiben dieses Projekt zahlreiche Haftungsfragen zu klären wären, starte ich hier erstmal mit einer nicht-öffentlichen Version. Ich freue mich über offenes und kritisches Feedback. Über Hinweise zu einer möglichen Lösung bzgl. der Haftungsfrage freue ich mich ebenfalls.</p>

        		<h2 id="feedback">Feedback:</h2>

        		<p>Gerne hier eintragen oder mir privat per <a href="https://twitter.com/m_andrasch">Twitter-DM</a> oder E-Mail (<a href="mailto:info@matthias-andrasch.de">info@matthias-andrasch.de</a>) zukommen lassen:</p>

                <p><b><a href="https://yourpart.eu/p/oerhoernchen-private-beta-feedback">Etherpad für Feedback</a></b></p>

                <p>Vielen Dank!</p>

        		<!-- <iframe name="embed_readwrite" src="https://yourpart.eu/p/oerhoernchen-private-beta-feedback?showControls=true&showChat=true&showLineNumbers=true&useMonospaceFont=false" width="100%" height="400"></iframe> -->

			</div>
		</div>
	</div>

