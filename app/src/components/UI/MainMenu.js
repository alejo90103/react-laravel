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
import { login, home, logout, register, showContact } from 'routes/routes';

const MainMenu = (state) => {
  
  return (
    <Navbar bg="dark" expand="lg" variant="dark">
      <Navbar.Brand href="#home">React-Bootstrap</Navbar.Brand>
      <Navbar.Toggle aria-controls="basic-navbar-nav" />
      <Navbar.Collapse id="basic-navbar-nav">
        <Nav className="mr-auto">
          {(state.Auth.user !== undefined) ? <Link to={home()} className='nav-link'>Home</Link> : <></>}
          {(state.Auth.user !== undefined) ? <Link to={showContact()} className='nav-link'>Contact</Link> : <></>}
        </Nav>
        <Nav>
          {(state.Auth.user === undefined) ? 
              <>
                <Link to={login()} className='nav-link'>Iniciar Sesión</Link>
                <Link to={register()} className='nav-link'>Registrarse</Link>
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
                  <Link to={logout()} className='nav-link' style={{ color: 'black' }}>Mi Perfil</Link>
                  <Dropdown.Divider />
                  <Link to={logout()} className='nav-link' style={{ color: 'black'}}>Salir</Link>
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
