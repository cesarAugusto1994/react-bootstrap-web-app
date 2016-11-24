/**
 * Created by cesar on 23/11/16.
 */

var React = require('react');
var ReactDOM = require('react-dom');
var {
    ButtonToolbar, Button, Grid, Row,
    Col, Form, FormGroup, FormControl, ControlLabel, Checkbox,
    Navbar, Nav, NavItem, NavDropdown, MenuItem, Carousel, Image, Thumbnail, Well,Accordion,Panel,ListGroup, ListGroupItem
} = require('react-bootstrap');

var Musica = React.createClass({
   
    getInitialState : function () {
        return {musica : []}  
    },
    
    load : function () {
        
        $.get('/user/musica/' + musicaId + '/get', function (result) {
            this.setState({musica : result});
        }.bind(this))
        
    },

    componentDidMount: function () {
        this.load();
    },
    
    render : function () {
        return (
            <Col xs={12} md={12}>
                <Panel header={this.state.musica.nome}>

                </Panel>
            </Col>
        )
    }
    
});

if (document.getElementById('musica')) {

    var musicaId = $('#musica').data('musica');

    ReactDOM.render(
        <Musica />, document.getElementById('musica')
    );
}