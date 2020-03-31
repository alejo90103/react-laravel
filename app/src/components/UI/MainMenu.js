import React, { useState } from 'react';
import { Link, useHistory } from 'react-router-dom';
import clsx from 'clsx';
import { connect, useDispatch } from 'react-redux';
import { makeStyles, useTheme } from '@material-ui/core/styles';
import { 
  Menu as MenuIcon,
  ChevronRight as ChevronRightIcon,
  ChevronLeft as ChevronLeftIcon,
  Home as HomeIcon,
  Person as PersonIcon,
  Palette as PaletteIcon
} from '@material-ui/icons';
import {
  AppBar,
  Toolbar,
  IconButton,
  Button,
  ListItem,
  ListItemText,
  ListItemIcon,
  Drawer,
  Divider,
  List,
  Typography,
  CssBaseline
} from '@material-ui/core';

import { login, home, logout, register, showContact } from 'routes/routes';
import { LightThemeAction, DarkThemeAction } from 'store/Theme/ThemeAction';

const drawerWidth = 240;

const useStyles = makeStyles((theme) => ({
  root: {
    display: 'flex',
  },
  title: {
    flexGrow: 1,
  },
  appBar: {
    zIndex: theme.zIndex.drawer + 1,
    transition: theme.transitions.create(['width', 'margin'], {
      easing: theme.transitions.easing.sharp,
      duration: theme.transitions.duration.leavingScreen,
    }),
  },
  appBarShift: {
    marginLeft: drawerWidth,
    width: `calc(100% - ${drawerWidth}px)`,
    transition: theme.transitions.create(['width', 'margin'], {
      easing: theme.transitions.easing.sharp,
      duration: theme.transitions.duration.enteringScreen,
    }),
  },
  menuButton: {
    marginRight: 36,
  },
  hide: {
    display: 'none',
  },
  drawer: {
    width: drawerWidth,
    flexShrink: 0,
    whiteSpace: 'nowrap',
  },
  drawerOpen: {
    width: drawerWidth,
    transition: theme.transitions.create('width', {
      easing: theme.transitions.easing.sharp,
      duration: theme.transitions.duration.enteringScreen,
    }),
  },
  drawerClose: {
    transition: theme.transitions.create('width', {
      easing: theme.transitions.easing.sharp,
      duration: theme.transitions.duration.leavingScreen,
    }),
    overflowX: 'hidden',
    width: theme.spacing(7) + 1,
    [theme.breakpoints.up('sm')]: {
      width: theme.spacing(9) + 1,
    },
  },
  toolbar: {
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'flex-end',
    padding: theme.spacing(0, 1),
    // necessary for content to be below app bar
    ...theme.mixins.toolbar,
  },
  content: {
    flexGrow: 1,
    padding: theme.spacing(3),
  },
}));

function MainMenu(state) {
  const dispatch = useDispatch();
  const history = useHistory();
  const classes = useStyles();
  const theme = useTheme();
  const [open, setOpen] = useState(false);

  const handleDrawerOpen = () => {
    setOpen(true);
  };

  const handleDrawerClose = () => {
    setOpen(false);
  };
  
  return (
    <div className={classes.root}>
      <CssBaseline />
      <AppBar
        position="fixed"
        className={clsx(classes.appBar, {
          [classes.appBarShift]: open,
        })}
      >
        <Toolbar>
          <IconButton
            color="inherit"
            aria-label="open drawer"
            onClick={handleDrawerOpen}
            edge="start"
            className={clsx(classes.menuButton, {
              [classes.hide]: open,
            })}
          >
            <MenuIcon />
          </IconButton>
          <Typography variant="h6" className={classes.title} noWrap>
            React
          </Typography>
          {(state.Auth.user === undefined) ?
              <>
                <Button color="inherit" onClick={()=>{history.push(login())}}>Login</Button>
                <Button color="inherit" onClick={() => { history.push(register()) }}>Register</Button>
              </>
            :
              <Button color="inherit" onClick={() => { history.push(logout()) }}>Logout</Button>
          }
        </Toolbar>
      </AppBar>
      <Drawer
        variant="permanent"
        className={clsx(classes.drawer, {
          [classes.drawerOpen]: open,
          [classes.drawerClose]: !open,
        })}
        classes={{
          paper: clsx({
            [classes.drawerOpen]: open,
            [classes.drawerClose]: !open,
          }),
        }}
      >
        <div className={classes.toolbar}>
          <IconButton onClick={handleDrawerClose}>
            {theme.direction === 'rtl' ? <ChevronRightIcon /> : <ChevronLeftIcon />}
          </IconButton>
        </div>
        <Divider />
        {(state.Auth.user !== undefined) &&
          <>
            <List>
              <ListItem button key='home'>
                <ListItemIcon onClick={() => { history.push(home()) }}>
                  <HomeIcon />
                </ListItemIcon>
                <ListItemText primary='Home' />
              </ListItem>
              <ListItem button key='contact'>
                <ListItemIcon onClick={() => { history.push(showContact()) }}>
                  <PersonIcon />
                </ListItemIcon>
                <ListItemText primary='Contact' />
              </ListItem>
            </List>
            <Divider />
          </>
        }
        <ListItem button key='theme'>
          <ListItemIcon onClick={() => { (state.Theme.type === 'dark') ? LightThemeAction(dispatch) : DarkThemeAction(dispatch) }}>
            <PaletteIcon />
          </ListItemIcon>
          <ListItemText primary='Cambiar Tema' />
        </ListItem>
      </Drawer>
    </div>
    
    // <Navbar bg="dark" expand="lg" variant="dark">
    //   <Navbar.Brand href="#home">React-Bootstrap</Navbar.Brand>
    //   <Navbar.Toggle aria-controls="basic-navbar-nav" />
    //   <Navbar.Collapse id="basic-navbar-nav">
    //     <Nav className="mr-auto">
    //       {(state.Auth.user !== undefined) ? <Link to={home()} className='nav-link'>Home</Link> : <></>}
    //       {(state.Auth.user !== undefined) ? <Link to={showContact()} className='nav-link'>Contact</Link> : <></>}
    //     </Nav>
    //     <Nav>
    //       {(state.Auth.user === undefined) ? 
    //           <>
    //             <Link to={login()} className='nav-link'>Iniciar Sesión</Link>
    //             <Link to={register()} className='nav-link'>Registrarse</Link>
    //           </>
    //         : 
    //           <>
    //             <DropdownButton
    //               as={ButtonGroup}
    //               key='left'
    //               id='dropdown-button-drop-left'
    //               drop='left'
    //               variant="secondary"
    //               title={state.Auth.user.name}
    //             >
    //               <Button className='nav-link' style={{ color: 'black' }}>Cambiar Tema</Button>
    //               <Dropdown.Divider />
    //               <Link to={logout()} className='nav-link' style={{ color: 'black'}}>Salir</Link>
    //             </DropdownButton>
    //           </>
    //       }
    //     </Nav>
    //   </Navbar.Collapse>
    // </Navbar>
  );
}

function mapStateToProps(state) {
  return state
};

export default connect(mapStateToProps)(MainMenu);
