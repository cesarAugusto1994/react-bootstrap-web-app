/**
 * Created by cesar on 24/11/16.
 */

var React = require('react');
var ReactDOM = require('react-dom');
var {
    ButtonToolbar, Button, Grid, Row,
    Col, Form, FormGroup, FormControl, ControlLabel, Checkbox,
    Navbar, Nav, NavItem, NavDropdown, MenuItem, Carousel, Image, Thumbnail, Well, Media, Accordion, Panel, ListGroup, ListGroupItem
} = require('react-bootstrap');

const ViewLogin = React.createClass({

    handleForm : function (e) {

        e.preventDefault();

        console.log(this.refs);

        var username = this.refs.username.value;
        var password = this.refs.password.value;

        block_screen();

        $.ajax({
            type: 'POST',
            url : "/admin/login_check",
            data : {
                _username : username,
                _password : password
            },
            cache: false,
            success: function (data) {
                window.location.href = '/user/';
            },
            error: function () {
                unblock_screen();
                alert("opss, algo deu errado...");
                return false;
            }
        });

        return false;
        
    },

    render: function () {
        return (
            <Col xs={12} md={12}>
                <div className="login-box">
                    <div className="login-logo">Cesar</div>
                    <div className="login-box-body">
                        <p className="login-box-msg">Entre para iniciar a sess&atilde;o</p>
                        <form method="post" onSubmit={this.handleForm}>
                            <div className="form-group has-feedback">
                                <input type="text" name="_username" ref="username" className="form-control" placeholder="Email ou Nickname"/>
                                    <span className="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div className="form-group has-feedback">
                                <input type="password" name="_password" ref="password" className="form-control" placeholder="Password" required="required" title="Informe a Senha" />
                                    <span className="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div className="row">
                                <div className="col-xs-12">
                                    <p className="control">
                                        <label className="checkbox icheck">
                                            <input type="checkbox" id="remember_me" name="_remember_me" />
                                                Lembrar-me
                                        </label>
                                    </p>
                                    <br/>
                                </div>
                                <div className="col-xs-6">
                                    <a href="#" className="btn btn-danger btn-block btn-flat">Registrar</a>
                                </div>
                                <div className="col-xs-6">
                                    <button type="submit" className="btn btn-success btn-block btn-flat">Entrar</button>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-xs-12"><br />
                                    <a href="#" className="btn btn-link btn-block btn-flat">P&aacute;gina Inicial.</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
            </Col>
        )
    }

});

if (document.getElementById('login')) {
    ReactDOM.render(
        <ViewLogin />, document.getElementById('login')
    );
}