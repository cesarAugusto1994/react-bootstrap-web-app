/**
 * Created by cesar on 21/11/16.
 */

var React = require('react');
var ReactDOM = require('react-dom');
var {
    ButtonToolbar, Button, Grid, Row,
    Col, Form, FormGroup, FormControl, ControlLabel, Checkbox,
    Navbar, Nav, NavItem, NavDropdown, MenuItem, Carousel, Image, Thumbnail
} = require('react-bootstrap');

const bs = {
    marginBottom : 0
};

const NavbarCustom = React.createClass({

    render: function () {
        return (
            <Navbar collapseOnSelect>
                <Navbar.Header>
                    <Navbar.Brand>
                        <a href="/">Blog</a>
                    </Navbar.Brand>
                    <Navbar.Toggle />
                </Navbar.Header>
                <Navbar.Collapse>
                    <Nav pullRight>
                        <NavItem eventKey={1} href="/login" name="login">Login</NavItem>
                        <NavItem eventKey={2} href="/" name="registrar">Registar</NavItem>
                    </Nav>
                </Navbar.Collapse>
            </Navbar>
        );
    }
});

var View = React.createClass({

    render: function () {
        return (
            <div>
                <CarouselCustom />
                <Collections />
            </div>
        )
    }
});

var CarouselCustom = React.createClass({

    getInitialState() {
        return {
            index: 0,
            direction: null
        };
    },

    handleSelect(selectedIndex, e) {
        this.setState({
            index: selectedIndex,
            direction: e.direction
        });
    },

    render: function () {
        return (
            <Carousel activeIndex={this.state.index} direction={this.state.direction} onSelect={this.handleSelect}>
                <Carousel.Item>
                    <img width={900} height={500} alt="900x500" src="/assets/img/backgound/apple_mountain-wallpaper-1920x1080.jpg"/>
                    <Carousel.Caption>
                        <h2>Nome do Site</h2>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                    </Carousel.Caption>
                </Carousel.Item>
                <Carousel.Item>
                    <img width={900} height={500} alt="900x500" src="/assets/img/backgound/a_kings_demise-wallpaper-2560x1440.jpg"/>
                    <Carousel.Caption>
                        <h3>Encontre</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </Carousel.Caption>
                </Carousel.Item>
                <Carousel.Item>
                    <img width={900} height={500} alt="900x500" src="/assets/img/backgound/never_alone___-wallpaper-1920x1080.jpg"/>
                    <Carousel.Caption>
                        <h3>Compartilhe</h3>
                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                    </Carousel.Caption>
                </Carousel.Item>
            </Carousel>
        )
    }
});

var Collections = React.createClass({
    
    getInitialState : function () {
        return {data : []}
    },
    
    load : function() {
        $.get('/user/colecoes/get', function (result) {
            this.setState({data : result})
        }.bind(this))
    },

    componentDidMount: function () {
        this.load();
    },

    render: function () {
        return (
            <div className="container marketing">
                <Grid>
                    <Row>
                        {this.state.data.map(function (colecao) {
                            var img = "/assets/img/colecoes/" + colecao.imagem;
                            var col = "/user/colecao/" + colecao.nome;
                            return (
                                <Col key={colecao.id} xs={12} md={3}>
                                    <a href={col}>
                                    <Thumbnail src={img} alt={colecao.nome}>
                                        <h3>{colecao.nome}</h3>
                                        <p>
                                            {colecao.descricao}
                                        </p>
                                    </Thumbnail>
                                        </a>
                                </Col>
                            )
                        })}
                    </Row>
                </Grid>
            </div>
        )
    }
});

if (document.getElementById('menuBar')) {
    ReactDOM.render(
        <NavbarCustom />, document.getElementById('menuBar')
    );
}

if (document.getElementById('app')) {
    ReactDOM.render(
        <View />, document.getElementById('app')
    );
}

