import React from 'react';
import { Link } from 'react-router-dom';
import { connect } from 'react-redux';
import {
  Navbar,
  Nav,
  DropdownButton,
  Dropdown,
  ButtonGroup
} from 'react-bootstrap';
import { login, home, logout, register } from 'routes/routes';

const MainMenu = (state) => {
  
  return (
    <Navbar bg="dark" expand="lg" variant="dark">
      <Navbar.Brand href="#home">React-Bootstrap</Navbar.Brand>
      <Navbar.Toggle aria-controls="basic-navbar-nav" />
      <Navbar.Collapse id="basic-navbar-nav">
        <Nav className="mr-auto">
          {(state.Auth.user !== undefined) ? <Nav.Link><Link to={home()}>Home</Link></Nav.Link> : <></>}
        </Nav>
        <Nav>
          {(state.Auth.user === undefined) ? 
              <>
                <Nav.Link><Link to={login()}>Iniciar Sesión</Link></Nav.Link>
              <Nav.Link><Link to={register()}>Registrarse</Link></Nav.Link>
              </>
            : 
              <>
                <DropdownButton
                  as={ButtonGroup}
                  key='left'
                  id='dropdown-button-drop-left'
                  drop='left'
                  variant="secondary"
                  title={state.Auth.user.name}
                >
                  <Dropdown.Item eventKey="1">Action</Dropdown.Item>
                  <Dropdown.Divider />
                  <Dropdown.Item eventKey="4"><Link to={logout()}>Salir</Link></Dropdown.Item>
                </DropdownButton>
              </>
          }
        </Nav>
      </Navbar.Collapse>
    </Navbar>
  );
}

function mapStateToProps(state) {
  return state
};

export default connect(mapStateToProps)(MainMenu);
