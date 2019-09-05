/* https://medium.appbase.io/how-to-build-a-movie-search-app-with-react-and-elasticsearch-2470f202291c */
/* app="oerhoernchen20"
          credentials="uPW3Wdmjv:356ded3b-f6ee-4b62-b189-67a0eae0c1f6"*/

/* https://codesandbox.io/s/github/appbaseio/reactivesearch/tree/next/packages/web/examples/ResultList?from-embed*/
/* Command Palette: From the command palette (ctrl/cmd + shift + p), type JsPrettier Format Code.*/
import React, {
    Component
} from 'react';
import {
    ReactiveBase,
    DataSearch,
    MultiList,
    RangeSlider,
    MultiDataList,
    SingleRange,
    SelectedFilters,
    ResultCard,
    ResultList,
    ReactiveList,
    SingleDropdownRange,
    DynamicRangeSlider,
    RangeInput,
    DateRange
} from '@appbaseio/reactivesearch';
import Interweave from 'interweave';
import Lightbox from "react-simple-lightbox";

import './App.css';

import Button from 'react-bootstrap/Button';
import ButtonToolbar from 'react-bootstrap/ButtonToolbar';
import Col from 'react-bootstrap/Col';
import Collapse from 'react-bootstrap/Collapse';
import Container from 'react-bootstrap/Container';
import Form from 'react-bootstrap/Form';
import FormControl from 'react-bootstrap/FormControl';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import NavDropdown from 'react-bootstrap/NavDropdown';
import Row from 'react-bootstrap/Row';
import Card from 'react-bootstrap/Card'

// https://stackoverflow.com/a/39333751
// 2DO: hot swapping is not possible, change it to dynamic version
// needs json loader for webpack
// (does not work by now, because data-prop of multi-list is not updated when values change)
import simpleOerTags from './data/simple_oer_tags.json';

// https://facebook.github.io/create-react-app/docs/using-global-variables
const OERHOERNCHEN_APPBASE_CREDENTIALS = window.OERHOERNCHEN_APPBASE_CREDENTIALS;
const OERHOERNCHEN_APPBASE_APP_NAME = window.OERHOERNCHEN_APPBASE_APP_NAME;

class App extends Component {

    /* try to load metadata_fields.json before, did not work */
    // https://stackoverflow.com/questions/30929679/react-fetch-data-in-server-before-render
    // https://github.com/appbaseio/reactivesearch/issues/373

    constructor(props) {
        super(props);

        /*this.state = {
            simpleTagFields: null
        };*/

        // This binding is necessary to make `this` work in the callback
        //this.activateLasers = this.activateLasers.bind(this);
    }

    componentWillMount() {
        // does not work right now
        //this.renderMyData();
    }

    /*activateLasers(){
        this.setState({
          educationalSectorsData:[]
        });
    }*/

    renderMyData() {

        // does not work right now :(

        /*fetch('https://raw.githubusercontent.com/programmieraffe/oerhoernchen-simple-tag-fields/master/data.json')
            .then((response) => response.json())
            .then((responseJson) => {
                console.log('reponse', responseJson)

                // convert to reactive-search format
                // ES6 - https://stackoverflow.com/questions/14379274/how-to-iterate-over-a-javascript-object
                var educationalSectorsData = [];
                for (let [key, translation] of Object.entries(responseJson.educational_sectors)) {
                    console.log(key, translation);
                    educationalSectorsData.push({'label':translation,'value':key});
                }

                this.setState({
                    educationalSectorsData: educationalSectorsData
                });
            })
            .catch((error) => {
                console.error(error);
            });*/
    }


    render() {
        return (

            <ReactiveBase app={OERHOERNCHEN_APPBASE_APP_NAME}
            credentials={OERHOERNCHEN_APPBASE_CREDENTIALS}>

            {/* <button onClick={this.activateLasers}>
              Activate Lasers
            </button> */}

            {/*<div>{JSON.stringify(this.state.educationalSectorsData)}</div>*/}

        {/* new react-bootstrap layout */}

        <Container fluid={true}>
          <Row>

            <Col xs={12} sm={12} md={3} lg={3} className="order-md-first order-lg-first">
                 <div className="filters-container">
                    <DataSearch
                      componentId="searchFilter"
                      className="filter"
                      dataField={["title","description","oerhoernchen_id"]}
                      //title="Search"
                      //defaultValue="Songwriting"
                      fieldWeights={[1, 3]}
                      placeholder="Suche nach Begriff(en)"
                      autosuggest={false}
                      highlight={false}
                      //defaultSuggestions={[{label: "Songwriting", value: "Songwriting"}, {label: "Musicians", value: "Musicians"}]}
                      //highlightField="group_city"
                      queryFormat="and"
                      fuzziness={0}
                      debounce={100}
                      /*react={{
                        and: ["CategoryFilter", "SearchFilter"]
                      }}*/
                      showFilter={true}
                      filterLabel="Begriffsuche"
                      URLParams={true}
                    />

                    {/* FOR LATER:
                    <MultiDataList
                    componentId="oerhoernchenIndexFilter"
                    dataField = "oerhoernchen_index"
                    className = "filter"
                    title = "SubIndex"
                    data={[{
                        "label":"Hochschule",
                        "value":"highereducation"
                    }]}
                    defaultValue={["Hochschule"]}
                    showSearch = {
                        false
                    }
                    URLParams = {
                        false
                    }
                    size={3}
                    />*/}

                    {/*<MultiDataList
                    componentId="speciaTopicsFilter"
                    dataField = "special_topics"
                    className = "filter"
                    title = "Spezial-Themen"
                    data={simpleOerTags.special_topics}
                    showSearch = {
                        false
                    }
                    URLParams = {
                        true
                    }
                    size={3}
                    />*/}

                    <MultiDataList
                    componentId="licenseTypeFilter"
                    dataField = "license_type"
                    className = "filter"
                    //defaultValue={["CC0","CC BY","CC BY-SA"]}
                    title = "Lizenz"
                    data={simpleOerTags.license_types}
                    showSearch = {
                        false
                    }
                    URLParams = {
                        true
                    }
                    />



                <MultiDataList
                componentId="oerhoernchenProjectKeyFilter"
                dataField = "projectkey"
                className = "filter"
                title = "Datenquelle"
                data={[{
                    "label":"OERBW/ZOERR",
                    "value":"zoerr"
                },{
                    "label":"HOOU-Portal",
                    "value":"hoou"
                },{
                  "label":"oncampus",
                  "value":"oncampus"
                },
              {
                "label":"TIB AV Portal",
                "value":"tibav"
              },{
                "label":"HHU Mediathek",
                "value":"hhu"
              },
            {
              "label":"digiLL",
              "value":"digill"
            },
          {
            "label":"openRUB",
            "value":"openrub"
          }]}
                showSearch = {
                    false
                }
                URLParams = {
                    true
                }
                size={3}
                />


                {  /*  <MultiDataList
                    componentId="educationalSectorsFilter"
                    dataField = "educational_sectors.keyword"
                    className = "filter"
                    title = "Bildungsbereich"
                    data={simpleOerTags.educational_sectors}
                    showSearch = {
                        false
                    }
                    showCount = {
                        false
                    }
                    URLParams = {
                        true
                    } /> */ }
                {/* use .keyword or not?!*/}
                {  /*  <MultiDataList
                    componentId="schoolSubjectsFilter"
                    dataField = "school_subjects"
                    className = "filter"
                    title = "Schule: Fächer"
                    data={simpleOerTags.school_subjects}
                    showSearch = {
                        false
                    }
                    URLParams = {
                        true
                    }
                    size={3}
                    showCount = {
                        false
                    }
                    />*/}

                    <MultiDataList
                    componentId="higherEducationSubjectsFilter"
                    dataField = "higher_education_subjects"
                    className = "filter"
                    title = "(coming soon?) Fachbereiche"
                    data={simpleOerTags.higher_education_subjects}
                    showSearch = {
                        false
                    }
                    URLParams = {
                        true
                    }
                    size={3}
                    showCount={false}
                    style={{"color": "#ECEBEB"}}
                    disabled={true}
                    />

                    {/*<RangeInput
                      componentId="createdYearFilter"
                      dataField="created_year"
                      className="filter"
                      title="Ratings"
                      range={{
                        "start": 1900,
                        "end": 2019
                      }}
                      defaultValue={{
                        "start": 1900,
                        "end": 2019
                      }}
                      rangeLabels={{
                        "start": "Start",
                        "end": "End"
                      }}
                      showFilter={true}
                      stepValue={1}
                      showHistogram={true}
                      interval={2}
                      URLParams={false}
                    />*/}

                    {/*<DateRange
                      componentId="entryAddedFilter"
                      dataField="entry_added"
                      title="Hinzugefügt"
                      className="filter"
                      queryFormat="basic_date_time"
                    />*/}

                    {/*<MultiList
                    componentId="tagsFilter"
                    dataField="tags.keyword"
                    className="filter"
                    title="Tags"
                    />*/}


                </div>
            </Col>

            <Col xs={12} sm={12} md={6} lg={6}>
                <div className="result-list-container">
                {/*<h3>Suchergebnisse</h3>*/}
                <SelectedFilters />
                <ReactiveList
                componentId="SearchResults"
                /*dataField = "entry_added"*/
                dataField="_id"
                className = "search-results-container"
                pagination
                URLParams
                /*sortBy="desc"*/
                /*sortOptions={[
                    {
                      label: "Best Match",
                      dataField: "_score",
                      sortBy: "desc"
                    },
                    {
                      label: "Asc",
                      dataField: "my_field",
                      sortBy: "asc"
                    }
                ]}*/
                // add all filters here - IMPORTANT!
                react={{
                    "and": [
                    "oerhoernchenProjectKeyFilter",
                    "licenseTypeFilter",
                    "higherEducationSubjectsFilter",
                    "speciaTopicsFilter",
                    "searchFilter",
                    "generalTypesFilter",
                    "technicalFormatsFilter"]
                }}
                render = {
                    ({
                        data
                    }) => ( <ReactiveList.ResultListWrapper> {
                            data.map(item => (

                            <Card key={item._id}>

                                        <div className="card-body" id={'entry-'+item._id}>

                                            <a href={item.main_url} target="_blank"><h4 className="card-title">{item.title}</h4></a>

                                            { typeof item.thumbnail_url !== 'undefined' && item.thumbnail_url != '' &&
                                              <Lightbox>
                                                <img src={item.thumbnail_url} className="thumbnail rounded float-left" alt="..." />
                                                </Lightbox>
                                            }



                                            <p className="card-text">
                                            {/*item.description !== null && item.description.substr(0,600)
                                              https://stackoverflow.com/a/27981876 */}
                                            <Interweave content={(item.description || "").substr(0,600)} />
                                            </p>

                                            <div className="hiddenDetails">
                                                General types: {item.general_types}<br/>
                                                Technical formats: {item.technical_formats}<br/>
                                                Educational sectors: {item.educational_sectors}<br/>
                                                HigherEd subjects: {item.higher_education_subjects}<br/>
                                                School subjects {item.school_subjects}.<br/>
                                                Tags: {item.tags}<br/>
                                                OERhörnchen-ID: {item.oerhoernchen_id}<br/>
                                                Elastic-ID: {item._id}
                                            </div>
                                        </div>
                                        {/* <div className="img-square-wrapper">
                                            <img className="thumbnail" src={item.thumbnail_url} alt="Card image cap"/>
                                        </div> */}
                                    <div className="card-footer">
                                        <small className="text-muted">Lizenz: {item.license_type} | Quelle:  {item.projectkey} {/*| Hinzugefügt am {item.entry_added} */}| <a className="tulluGenerator" href={'https://beta.oerhoernchen.de/tullu_generator/?id='+item._id}>
                                                TULLU-Lizenzhinweis erstellen (coming soon)</a> | <a href={'?searchFilter="'+item.oerhoernchen_id+'"'}>Link</a></small>
                                    </div>


                                {/* <div className="flex column justify-space-between">
                                        Lizenz: {item.license_type}<br/>
                                        Bildungsbereich: {item.educational_sectors && item.educational_sectors.join(",")}<br/>
                                        Beschreibung: {item.description.substring(0, 200)}<br/>
                                        Lizenz-Attribution: {item.license_attribution} <br/>
                                        Spezial-Thema: {item.special_topics && item.special_topics.join(",")}<br/>
                                        Schule: {item.school_subjects && item.school_subjects.join(",")}<br/>
                                        Hochschule: {item.higher_education_subjects && item.higher_education_subjects.join(",")}<br/>
                                        Erstellungsjahr: {item.created_year}<br/>
                                        Art: {item.general_types && item.general_types.join(",")}<br/>
                                        Technische Formate: {item.technical_formats && item.technical_formats.join(",")}<br/>
                                        Hinzugefügt: {item.entry_added}<br/>
                                        URL: {item.main_url}
                                        </div> */}



                                {/* 2DO: do we need this?
                                <div className = "title"
                                dangerouslySetInnerHTML = {
                                    {
                                        __html: item.title,
                                    }
                                }
                                /> */}

                                </Card>))
                        } </ReactiveList.ResultListWrapper>
                    )
                }/>{/*eo reactiveList*/}
            </div>
            </Col>

            <Col xs={12} sm={12} md={3} lg={3}>
                 <div className="filters-container">
                    <MultiDataList
                    componentId="generalTypesFilter"
                    dataField = "general_types"
                    style={{"color": "#ECEBEB"}}
                    className = "filter"
                    title = "(coming soon?) Material ist/enthält"
                    data={simpleOerTags.general_types}
                    showSearch = {
                        false
                    }
                    URLParams = {
                        true
                    }
                    />

                    <MultiDataList
                    componentId="technicalFormatsFilter"
                    dataField = "technical_formats"
                    className = "filter"
                    title = "(coming soon?) Technische Formate"
                    data={simpleOerTags.technical_formats}
                    style={{"color": "#ECEBEB"}}
                    showSearch = {
                        false
                    }
                    URLParams = {
                        true
                    }
                    />



                 </div>
            </Col>
          </Row>
          <Row>
            <Col lg={12}></Col>
          </Row>
        </Container>
        {/* eo new react-bootstrap layout */}
         </ReactiveBase>
        );
    }
}

export default App;
