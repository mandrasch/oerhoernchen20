
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

    <div class="container">
        <div class="row">

          <p style="color:red;">Derzeit deaktiviert - das Eintragen kann aus Haftungsgründen nicht öffentlich freigeschaltet werden derzeit, es handelt sich hier nur um einen Prototypen. Siehe Infos <a href="<?php echo site_url("/infos-hinzufuegen");?>">hier</a>.</p>

<div class="mx-auto col-lg-9 col-sm-12">
                    <!-- form user info -->


                    <div class="card" style="margin-top:20px;">
                        <!-- <div class="card-header">
                           Sonstiges
                        </div> -->

                        <div class="card-body text-center" style="font-family:'Open Sans'">
                            <div class="dropdown">
                              <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Beispieldaten laden
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" id="load-sample-data-json-3" href="#">digiLL - modulare Kurseinheit</a>
                                <a class="dropdown-item" id="load-sample-data-json-1" href="#">Videoreihe TIB AV</a>
                                <a class="dropdown-item" id="load-sample-data-json-0" href="#">Video-ZOERR (URL -> schema.org -> auf "Analyse" klicken)</a>
                                <a class="dropdown-item" id="load-sample-data-json-2" href="#">Modul oer.uni-leipzig.de</a>
                              </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" id="card-form">
                        <div class="card-header">
                            <h4 class="mb-0">URL zum Index hinzufügen</h4>
                        </div>
                        <div class="card-body">
                            <form id="oerhoernchen20-add-form" class="form-horizontal" role="form">

                                <div class="form-group row" style="color:#999;">
                                    <label class="col-lg-3 col-form-label form-control-label">Erfassung in:</label>
                                    <div class="col-lg-9">
                                        <select name="index" class="form-control" data-role="select" selected="selected" required="required" data-parsley-errors-container="#errId8" style="color:#999;">
                                            <option value="playground">Interner Demo-Playground (Empfohlen)</option>
                                            <?php if ($is_editorial_staff): ?>
                                                <option value="github">Öffentliche Github-Demo</option>
                                            <?php endif;?>
                                            <option value="official">Öffentlicher Index (> erfordert Freischaltung)</option>
                                              <option value="highereducation">Öffentlicher Index Hochschule</option>
                                              <option value="highereducation-crawltest"> Index Hochschule (Crawltest)</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"><b>Haupt-URL *</b></label>
                                    <div class="col-lg-9">
                                        <div class="input-group mb-3">
                                          <input class="form-control" name="main_url" type="text" placeholder="https://">
                                          <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" id="button-url-check" type="button">Analyse</button>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"><b>Titel *</b></label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="title">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label custom-no-padding-top">Beschreibung</label>
                                    <div class="col-lg-9">
                                          <textarea name="description" rows="3" class="form-control k-textbox" data-role="textarea"></textarea><small class="form-text text-muted">Hier sollte möglichst eine Beschreibung stehen, die das Einsatzszenario, die Zielgruppe sowie ggf. den Entstehungskontext für andere Lehrende beschreibt.</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Vorschaubild (URL)</label>
                                    <div class="col-lg-9">
                                          <input class="form-control" type="text" name="thumbnail_url" value="" placeholder="https://"/>
                                        <?php // Important - do not delete this ?>
                                        <input type="hidden" name="imgur_url" />
                                        <input type="hidden" name="imgur_delete_hash" />

                                        <button disabled>Hochladen</button>

                                        <!-- disabled by now -->
                                        <!-- <div class="card">
                                        <div class="card-header">
                                            <span class="collapsed d-block" data-toggle="collapse" href="#collapse-collapsed" aria-expanded="true" style="cursor:pointer;" aria-controls="collapse-collapsed" id="heading-collapsed">
                                                <i class="fa fa-chevron-down float-right"></i>
                                                <small>Hochladen via imgur</small>
                                            </span>
                                        </div>
                                        <div id="collapse-collapsed" class="collapse" aria-labelledby="heading-collapsed">
                                            <div class="card-body">
                                                <p><small class="form-text text-muted">Dies ist ein optionales Angebot. Das Hochladen erfolgt über den externen Service Imgur, bitte beachte die <a href="https://imgur.com/tos" target="_blank">AGB</a> und <a href="https://imgur.com/privacy" target="_blank">Datenschutzbedingungen</a>. Bitte achte unbedingt auf die geltende Urheberrechtsgesetzgebung.</small></p>

                                                <div
                                          class="dropzone"
                                          id="imgur-dropzone">
                                          </div>
                                          <a class="btn-sm btn-secondary" id="imgur-dropzone-remove" style="display:none;">Bild von imgur löschen</a>

                                            </div>
                                        </div>
                                    </div> -->


                                    </div>

                                </div>


    <?php /*if ($this->ion_auth->logged_in()): ?>

<div class="form-group row">
<label class="col-lg-3 col-form-label form-control-label"></label>
<div class="col-lg-9">
<label>Vorschaubild (URL): </label>
<input
type="hidden"
role="uploadcare-uploader"
data-image-shrink="400x400" />
</div>
</div>

<?php endif; */?>




                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"><b>Lizenzart *</b></label>
                                    <div class="col-lg-9">
                                        <select name="license_type" class="form-control" data-role="select" selected="selected" required="required" data-parsley-errors-container="#errId8">
                                            <option value="other"></option>
                                            <?php foreach ($license_types as $type): ?>

                                                <option value="<?php echo $type->value; ?>"><?php echo $type->label; ?></option>

                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Lizenz-Version (URL)</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="license_url"  value="">
                                        <small class="form-text text-muted">Hier bitte - falls im Material ersichtlich - die genaue URL der Lizenz eintragen, z.B. https://creativecommons.org/licenses/by/4.0/deed.de (optionale Angabe, die aber Nachnutzer*innen weiter hilft, vgl. <a href="http://open-educational-resources.de/oer-tullu-regel/" target="_blank">TULLU-Regel</a>)</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Attribution der Autor*innen</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" name="license_attribution" rows="3" class="form-control k-textbox"></textarea>
                                        <small class="form-text text-muted">Dies ist bei Einzelpersonen oft direkt der Name der Urheberin bzw. des Urhebers - mehrere bitte mit Komma abtrennen (Beispiel: <i>Marie Mustermensch, Marola Mustermensch</i>). Materialien können aber ebenso von Organisationen oder Vereinen unter freier Lizenz veröffentlicht worden sein (Beispiel: <i>ZUM e.V.</i> oder <i>Marie Mustermensch für Muster e.V.</i>)</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Erstellungsjahr</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="created_year"  value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label custom-no-padding-top">OER World Map</label>
                                    <div class="col-lg-9">
                                        <label><i>Coming soon - Verlinkungen zu Projekten/Personen auf der OER World Map</i></label>
                                        <!--<small class="form-text text-muted">Hier können Einträge von der OER World Map verlinkt werden.</small>-->
                                    </div>
                                </div>




                                  <!-- <div class="row">
                                    <div lass="col-12 ">
                                        <h3>Kategorisierung</h3>
                                    </div>
                                  </div> -->

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label custom-no-padding-top"><b>Kategorisierung *</b></label>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <b>Material ist/enthält</b>
                                                <?php $i = 0;?>
                                                <?php foreach ($general_types as $type): ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="<?php echo $type->value; ?>" name="general_types" id="typeCheck<?php echo $i; ?>">
                                                        <label class="form-check-label" for="typeCheck<?php echo $i; ?>"><?php echo $type->label; ?></label>
                                                    </div>
                                                <?php $i++;?>
                                                <?php endforeach;?>
                                            </div> <!-- eo col-md-6 -->
                                            <div class="col-md-6">
                                                <b>Tools / Dateiformate</b>
                                                <?php $i = 0;?>
                                                <?php foreach ($technical_formats as $format): ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="<?php echo $format->value; ?>" name="technical_formats" id="toolsCheck<?php echo $i; ?>">
                                                        <label class="form-check-label" for="toolsCheck<?php echo $i; ?>"><?php echo $format->label; ?></label>
                                                    </div>
                                                <?php $i++;?>
                                                <?php endforeach;?>
                                            </div> <!-- eo col-md-6 -->

                                        </div><!-- eo row -->
                                    </div> <!-- eo col-lg-9 -->
                                </div><!-- eo form-group row -->



                                <div class="form-group row" style="display:none;">

                                    <label class="col-lg-3 col-form-label form-control-label custom-no-padding-top"><b>Bildungsbereich *</b></label>
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                         <!--<label class="form-control-label">
                                          </label>-->
                                        <?php foreach ($educational_sectors as $sector): ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="<?php echo $sector->value; ?>" name="educational_sectors" id="sectorCheck<?php echo $i; ?>">
                                                        <label class="form-check-label" for="sectorCheck<?php echo $i; ?>"><?php echo $sector->label; ?></label>
                                                    </div>
                                        <?php $i++;?>
                                        <?php endforeach;?>
                                        <small class="form-text text-muted">Wurde das Material speziell für einen Bildungsbereich erstellt, in welchem es eingesetzt werden soll? Falls das Material bereichsübergreifend eingesetzt werden kann, dann bitte hier <u>alle</u> auswählen.</small>
                                       </div>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <label class="col-lg-3 col-form-label form-control-label custom-no-padding-top">Spezial-Thema?</label>
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                        <?php foreach ($special_topics as $item): ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="<?php echo $item->value; ?>" name="special_topics" id="specialTopicCheck<?php echo $i; ?>">
                                                    <label class="form-check-label" for="specialTopicCheck<?php echo $i; ?>"><?php echo $item->label; ?></label>
                                                </div>
                                        <?php $i++;?>
                                        <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row" style="display:none;">
                                    <label class="col-lg-3 col-form-label form-control-label custom-no-padding-top">Schule: Fach?</label>
                                    <div class="col-lg-9">
                                          <?php foreach ($school_subjects as $item): ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="<?php echo $item->value; ?>" name="school_subjects" id="schoolSubjectsCheck<?php echo $i; ?>">
                                                        <label class="form-check-label" for="schoolSubjectsCheck<?php echo $i; ?>"><?php echo $item->label; ?></label>
                                                    </div>
                                        <?php $i++;?>
                                        <?php endforeach;?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label custom-no-padding-top">Hochschule: Fachbereich?</label>
                                    <div class="col-lg-9">
                                          <?php foreach ($higher_education_subjects as $item): ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="<?php echo $item->value; ?>" name="higher_education_subjects" id="higherEducationSubjectsCheck<?php echo $i; ?>">
                                                        <label class="form-check-label" for="higherEducationSubjectsCheck<?php echo $i; ?>"><?php echo $item->label; ?></label>
                                                    </div>
                                        <?php $i++;?>
                                        <?php endforeach;?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Tags?</label>
                                    <div class="col-lg-9">
                                          <textarea name="tags" rows="3" class="form-control k-textbox" data-role="textarea"></textarea><small class="form-text text-muted">Falls noch Informationen fehlen, können diese hier als Schlagwort ergänzt werden. Die Tags können mit "," voneinander getrennt werden</small>
                                    </div>
                                </div>


                               <div class="form-group row" style="display:none;">
                                    <label class="col-lg-3 col-form-label form-control-label">Rohdateien-URL</label>
                                    <div class="col-lg-9">
                                         <input class="form-control" name="raw_url" type="text" value="" placeholder="https://">
                                         <small class="form-text text-muted">Falls die Inhalte als Quelltext in einem Git-Repository hinterlegt sind, die Quelldatei für ein Video verfügbar ist oder ein LMS-Kurs als zip-Datei verfügbar ist, kann diese URL hier eingetragen werden.</small>
                                    </div>
                                </div>

                                <div class="form-group row" style="display:none;">
                                    <label class="col-lg-3 col-form-label form-control-label custom-no-padding-top">schema.org-Metadaten (JSON)</label>
                                    <div class="col-lg-9">
                                          <textarea name="schema_org_metadata_json" rows="3" class="form-control k-textbox" data-role="textarea"></textarea><small class="form-text text-muted"></small>
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-top:50px;">
                                     <div class="col-12 text-center">
                                        <div class="form-check" style="margin-bottom:10px;font-size:16px;">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
                                          <label class="form-check-label" for="defaultCheck1">
                                            Ich stimme den <a href="#">Nutzungsbedingungen</a> zu und versichere, keine rechtswidrigen Informationen angegeben bzw. hochgeladen zu haben.
                                          </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-12 text-center">
                                      <p style="color:red;">Derzeit deaktiviert - das Eintragen kann aus Haftungsgründen nicht öffentlich freigeschaltet werden derzeit, es handelt sich hier nur um einen Prototypen. Siehe Infos <a href="<?php echo site_url("/infos-hinzufuegen");?>">hier</a>.</p>
                                      <button class="btn btn-success btn-lg" id="submit-entry" disabled><i class="fas fa-check"></i> Lezeichen eintragen</button>
                                      <br /><small><a href="" id="reset-form" class="reset-form text-mutedana">Zurücksetzen</a></small>
                                  </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Sub-URLs</label>
                                    <div class="col-lg-9">
                                        <label><small class="form-text text-muted">Falls weitere Online-Inhalte zu diesem Material gehören, die <u>nicht</u> unter der Haupt-URL erreichbar sind, können diese hier eingetragen werden.</small></label>
                                    </div>
                                </div> -->
                            </form>
                        </div><!-- eo card-body -->
                    </div><!-- eo card -->
            </div><!-- eo col -->

            <!-- <div class="col col-lg-3 sm-12">
                <div id="sidebar" class="sticky-top"> -->
                    <!-- <div class="card" >
                        <div class="card-header">
                            Fertigstellen
                        </div>


                        <div class="card-body text-center">

                        <div class="form-check" style="margin-bottom:10px;font-size:16px;">
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                          <label class="form-check-label" for="defaultCheck1">
                            Ich stimme den <a href="#">AGB</a> zu
                          </label>
                        </div>


                            <button class="btn btn-success btn-lg" id="submit-entry"><i class="fas fa-check"></i> Eintragen</button>
                            <br /><small><a href="" id="reset-form" class="reset-form text-mutedana">Zurücksetzen</a></small>
                        </div>
                    </div>-->

                    <!-- <div class="card" style="margin-top:20px;">
                         <div class="card-header">
                           Sonstiges
                        </div>
                        <div class="card-body text-center">
                            <div class="dropdown">
                              <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Beispieldaten
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" id="load-sample-data-json-3" href="#">digiLL - modulare Kurseinheit</a>
                                <a class="dropdown-item" id="load-sample-data-json-1" href="#">Videoreihe TIB AV</a>
                                <a class="dropdown-item" id="load-sample-data-json-0" href="#">Video-ZOERR (URL -> schema.org)</a>
                                <a class="dropdown-item" id="load-sample-data-json-2" href="#">Modul oer.uni-leipzig.de</a>
                              </div>
                            </div>
                        </div>
                    </div> -->



                   <!-- </div>
            </div> -->


        </div><!-- eo row -->

    </div><!-- eo container -->

    <!--

        <div class="row">
            <form id="oerhoernchen20-add-form" class="form-horizontal" role="form" data-parsley-validate novalidate>
                <div class="container-fluid shadow">
                    <div class="row">
                        <div id="valErr" class="row viewerror clearfix hidden">
                            <div class="alert alert-danger">Oops! Seems there are some errors..</div>
                        </div>
                        <div id="valOk" class="row viewerror clearfix hidden">
                            <div class="alert alert-success">Yay! ..</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group brdbot" style="display: block;">
                                    <h3>OERhörnchen 2.0 - Modul eintragen</h3>
                                    <div class="controls col-sm-9">
                                        <p id="field96" data-default-label="Header" data-default-is-header="true" data-control-type="header"></p><span id="errId1" class="error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label control-label-left col-sm-3" for="HauptURL:">Haupt-URL:<span class="req"> *</span></label>
                                    <div class="controls col-sm-9">
                                        <input type="text" name="main_url" class="form-control k-textbox" data-role="text" placeholder="https://" required="required" value="https://oer.uni-leipzig.de/lerninhalt/goetter-und-alltagswelt-im-antiken-griechland-erzaehlt-von-zeus-athena-poseidon-ares-und-aphrodite/"><span class="help-block">2DO: BEISPIEL ANSCHAUEN // Falls es sich nur um ein einzelnes Element handelt, z.B. eine Pr?sentation oder ein Video, die Haupt-URL einfach noch einmal als Sub-URL eintragen und das Format erfassen.</span><span id="errId2" class="error"></span></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label control-label-left col-sm-3" for="title">Titel:</label>
                                    <div class="controls col-sm-9">
                                        <input name="title"  value="Götter- und Alltagswelt im antiken Griechenland – erzählt von Zeus, Athena, Poseidon, Ares und Aphrodite" type="text" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId3"><span id="errId3" class="error"></span></div>
                                </div>
                                <div class="row">

                                    <div class="col-md12">


                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group brdbot">
                                            <h3>Details</h3>
                                            <div class="controls col-sm-9">
                                                <p id="field17" data-default-label="Header" data-default-is-header="true" data-control-type="header"></p><span id="errId4" class="error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group" style="display: block;">
                                            <label class="control-label control-label-left col-sm-3" for="EditURL:">Edit-URL:</label>
                                            <div class="controls col-sm-9">
                                                <input name="edit_url" type="text" class="form-control k-textbox" data-role="text" placeholder="https://" data-parsley-errors-container="#errId5"><span class="help-block">Falls zu dem Inhalt bspw. ein Github/Gitlab-Repository geh?rt oder eine bearbeitbare Datei hinterlegt ist.</span><span id="errId5" class="error"></span></div>
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label class="control-label control-label-left col-sm-3" for="Kurzbeschreibung:">Kurzbeschreibung:</label>
                                            <div class="controls col-sm-9">
                                                <textarea name="description" rows="3" class="form-control k-textbox" data-role="textarea" data-parsley-errors-container="#errId6">Das vorliegende Projekt „Die Götter- und Alltagswelt im antiken Griechenland – Erzählt von Zeus, Athena, Poseidon, Ares und Aphrodite“ erweckt die griechischen Götter für die SchülerInnen zum Leben. Dies geschieht durch Hörspiele, in denen die Götter Zeus, Athena, Poseidon, Ares und Aphrodite selbst von ihrem Leben als Gottheit, ihrem Aufgabenbereich aber auch von verschiedenen Bereichen aus dem Alltag der Menschen des antiken Griechenlands erzählen. Jede Station besteht aus einem Hörspiel und einem Aufgabenblatt, durch das die SchülerInnen den Gott und sein Themenfeld kennenlernen. Der Unterrichtsvorschlag ist geplant für eine Exkursion in das Antikenmuseum der Universität Leipzig oder mehrere Geschichtsstunden an der Schule für die 5. Klasse. Die Arbeitsmaterialien liegen differenziert in zwei Niveaustufen vor. Zudem ist ein Vorschlag für eine prozessorientierte Bewertung sowie eine schriftliche Leistungskontrolle enthalten.</textarea><span class="help-block">Hier sollte m?glichst eine Beschreibung stehen, die das Einsatzszenario, die Zielgruppe, Entstehungskontext für andere Lehrende beschreibt.</span><span id="errId6" class="error"></span></div>
                                        </div>




                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="Rechteinhaber*in:">Rechteinhaber*in:<span class="req"> *</span></label>
                                            <div class="controls col-sm-9">
                                                <input name="license_attribution" value="Universität Leipzig (Laura Hartleb, Anne Kiss, Dennis Fröbrich, Erik Fischer)" type="text" class="form-control k-textbox" data-role="text" required="required" placeholder="Marie Mustermensch oder ZUM e.V." data-parsley-errors-container="#errId7"><span class="help-block">Dies ist bei Einzelpersonen oft direkt der Name der Urheberin bzw. des Urhebers. Materialien k?nnen aber ebenso von Organisationen oder Vereinen unter freier Lizenz ver?ffentlicht worden sein.</span><span id="errId7" class="error"></span></div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="Bildungsbereich:">Bildungsbereich:</label>
                                            <div class="controls col-sm-9">
                                                <select name="primary_educational_sector" class="form-control" data-role="select" data-parsley-errors-container="#errId9">
                                                    <option value=""></option>
                                                    <option value="higher_education">Hochschule</option>
                                                    <option value="school" selected>school</option>
                                                    <option value="Option 3">Option 3</option>
                                                    <option value="Option 4">Option 4</option>
                                                </select><span class="help-block">2DO: WORLD MAP VALUES! / Andere Bildungsbereich coming soon... </span><span id="errId9" class="error"></span></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label control-label-left col-sm-3" for="Fachbereich:">Fachbereich:</label>
                                            <div class="controls col-sm-9">
                                                <input id="Fachbereich:" type="text" class="form-control k-textbox" data-role="text" data-parsley-errors-container="#errId10"><span class="help-block">2DO: hochschulkompass von Adrian o.?. laden (SP?TER?)</span><span id="errId10" class="error"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group brdbot">
                                            <h3>Sub-Content</h3>
                                            <div class="controls col-sm-9">
                                                <p id="field18" data-default-label="Header" data-default-is-header="true" data-control-type="header">Dazugeh?rige Materialien, z.B. Nuggets, die eine eigene URL haben 2DO: Disclaimer Lizenzen k?nnen abweichen</p><span id="errId11" class="error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group" style="display: block;">
                                            <label class="sr-only control-label control-label-left col-sm-3"></label>
                                            <div class="controls col-sm-9">
                                                <label class="checkbox-inline" for="checkbox918"><input type="checkbox" value="Lizenz der Sub-Contents weicht ab" id="checkbox918" name="field917" data-parsley-errors-container="#errId12">Lizenz der Sub-Contents weicht ab</label><span id="errId12" class="error"></span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12"><button name="append-sub-url">+</button></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-10 sub-urls">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button id="button180" type="button" class="btn btn-default">Zur?cksetzen</button> <button name="submit-form" type="button" class="btn btn-primary btn-default" name="">Eintragen</button> <button  type="button" class="btn btn-primary btn-default">Eintragen und weiteren Eintrag erstellen</button> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>-->
        <div id="server-results"></div>
    </div>


</div><!-- eo row -->
</div><!-- eo container -->
