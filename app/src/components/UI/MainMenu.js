import React, { useState } from 'react';
import { useHistory } from 'react-router-dom';
import clsx from 'clsx';
import { connect, useDispatch } from 'react-redux';
import { IntlActions } from 'react-redux-multilingual'
import { useTranslate } from 'react-redux-multilingual'
import { makeStyles, useTheme } from '@material-ui/core/styles';
import { 
  Menu as MenuIcon,
  ChevronRight as ChevronRightIcon,
  ChevronLeft as ChevronLeftIcon,
  Home as HomeIcon,
  Person as PersonIcon,
  Palette as PaletteIcon,
  Translate as TranslateIcon,
  KeyboardArrowDown as KeyboardArrowDownIcon
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
  Menu,
  MenuItem,
  CssBaseline,
  useMediaQuery
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
  const t = useTranslate()
  const dispatch = useDispatch();
  const history = useHistory();
  const classes = useStyles();
  const theme = useTheme();
  const [open, setOpen] = useState(false);
  const [anchorEl, setAnchorEl] = React.useState(null);
  const matches = useMediaQuery('(min-width:600px)');

  const handleDrawerOpen = () => {
    setOpen(true);
  };

  const handleDrawerClose = () => {
    setOpen(false);
  };

  const handleClick = (event) => {
    setAnchorEl(event.currentTarget);
  };

  const handleClose = () => {
    setAnchorEl(null);
  };

  const changeLanguage = (lang) => {
    setAnchorEl(null);
    console.log(lang);
    dispatch(IntlActions.setLocale(lang))
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
            {t('MainMenu.title')}
          </Typography>
          <Button
            startIcon={<TranslateIcon />}
            endIcon={<KeyboardArrowDownIcon />}
            aria-controls="simple-menu"
            aria-haspopup="true" color="inherit"
            onClick={handleClick}
          >
            {matches && t('MainMenu.language.title')}
          </Button>
          <Menu
            id="simple-menu"
            anchorEl={anchorEl}
            keepMounted
            open={Boolean(anchorEl)}
            onClose={handleClose}
          >
            <MenuItem onClick={changeLanguage.bind(this, 'en')}>{t('MainMenu.language.en')}</MenuItem>
            <MenuItem onClick={changeLanguage.bind(this, 'es')}>{t('MainMenu.language.es')}</MenuItem>
          </Menu>
          {(state.Auth.user === undefined) ?
              <>
                <Button color="inherit" onClick={() => { history.push(login()) }}>{t('MainMenu.login')}</Button>
                <Button color="inherit" onClick={() => { history.push(register()) }}>{t('MainMenu.register')}</Button>
              </>
            :
              <Button color="inherit" onClick={() => { history.push(logout()) }}>{t('MainMenu.logout')}</Button>
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
                <ListItemText primary={t('MainMenu.menu.home')} />
              </ListItem>
              <ListItem button key='contact'>
                <ListItemIcon onClick={() => { history.push(showContact()) }}>
                  <PersonIcon />
                </ListItemIcon>
                <ListItemText primary={t('MainMenu.menu.contact')} />
              </ListItem>
            </List>
            <Divider />
          </>
        }
        <ListItem button key='theme'>
          <ListItemIcon onClick={() => { (state.Theme.type === 'dark') ? LightThemeAction(dispatch) : DarkThemeAction(dispatch) }}>
            <PaletteIcon />
          </ListItemIcon>
          <ListItemText primary={t('MainMenu.menu.theme')} />
        </ListItem>
      </Drawer>
    </div>
  );
}

function mapStateToProps(state) {
  return state
};

export default connect(mapStateToProps)(MainMenu);
