/**
 * Created by cesar on 22/11/16.
 */

var React = require('react');
var ReactDOM = require('react-dom');
var {
    ButtonToolbar, Button, Grid, Row,
    Col, Form, FormGroup, FormControl, ControlLabel, Checkbox,
    Navbar, Nav, NavItem, NavDropdown, MenuItem, Carousel, Image, Thumbnail, Well, Media, Accordion, Panel, ListGroup, ListGroupItem
} = require('react-bootstrap');

const styleBtnFloat = {
    float: 'right'
};

const Btn = React.createClass({

    render: function () {
        return (
            <i className={this.props.classIcon}></i>
        )
    }

});

var ViewCategorias = React.createClass({

    getInitialState: function () {
        return {colecoes: [], musicas: [], value: 'A', nomeCategoria: 'Musicas', activeItem: '', anexos: []}
    },

    load: function () {
        $.get('/user/colecoes/get', function (result) {
            this.setState({colecoes: result})
        }.bind(this));

        $.get('/user/colecao/' + colecaoId + '/musicas', function (result) {
            this.setState({musicas: result})
        }.bind(this))
    },

    handleLoadMusicas: function (e) {

        if (e.target.dataset.id) {
            this.setState({value: e.target.dataset.id});
            this.setState({activeItem: e.target.dataset.id});
        }

        if (e.target.dataset.nome) {
            this.setState({nomeCategoria: e.target.dataset.nome});
        }

        block_screen();

        $.get('/user/categoria/' + e.target.dataset.nome + '/musicas', function (result) {
            this.setState({musicas: result})
        }.bind(this)).done(function () {
            unblock_screen();
        });

    },

    componentDidMount: function () {
        this.load();
    },

    render: function () {
        var _this = this;
        return (
            <div>
                <Col xs={12} md={3}>
                    <Accordion>
                        {this.state.colecoes.map(function (colecao) {
                            return (
                                <Panel bsStyle="danger" header={colecao.nome} key={colecao.id} eventKey={colecao.id}>

                                        {colecao.categorias.map(function (categoria) {
                                            return (
                                                <ListGroupItem key={categoria.id} onClick={_this.handleLoadMusicas}
                                                               data-id={categoria.id} data-nome={categoria.nome}
                                                               value={categoria.id}>{categoria.nome}</ListGroupItem>
                                            )
                                        })}
                                </Panel>
                            )
                        })}
                    </Accordion>
                </Col>
                <Col xs={12} md={9}>
                    <Panel bsStyle="danger" header={this.state.nomeCategoria} eventKey="1">
                        <Accordion>
                            {this.state.musicas.map(function (musica) {
                                var linkMusica = '/user/musica/' + musica.nome;
                                return (
                                    <Panel header={musica.numero_nome} key={musica.id} eventKey={musica.id}>
                                        {musica.anexos.map(function (anexo) {
                                            return (
                                                <Media key={anexo.id}>
                                                    <Media.Left>
                                                        <img width={64} height={64} src="/assets/img/circle.png"
                                                             alt="Image"/>
                                                    </Media.Left>
                                                    <Media.Body>
                                                        <Media.Heading>{anexo.nome}</Media.Heading>
                                                        <ButtonToolbar>
                                                            <Button bsStyle="success" bsSize="xsmall">Baixar</Button>
                                                            <Button bsStyle="danger" bsSize="xsmall">Remover</Button>
                                                        </ButtonToolbar>
                                                    </Media.Body>
                                                </Media>
                                            )
                                        })}
                                    </Panel>
                                )
                            })}
                        </Accordion>
                    </Panel>
                </Col>
            </div>
        )
    }
});

if (document.getElementById('categorias')) {

    var colecaoId = $('#categorias').data('colecao');

    ReactDOM.render(
        <ViewCategorias />, document.getElementById('categorias')
    );
}
