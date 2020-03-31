import React, { lazy, Suspense } from 'react';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import { ToastProvider } from 'react-toast-notifications'
import { connect } from 'react-redux';
import { makeStyles } from '@material-ui/core/styles';
import { MuiThemeProvider, createMuiTheme } from "@material-ui/core/styles";

import MainMenu from 'components/UI/MainMenu';
import { login, home, logout, register, showContact, addContact, editContact } from 'routes/routes';
import RequireAuth from 'components/hoc/RequireAuth';
import Loading from 'components/page/Loading';

const Home = lazy(() => import('components/page/Home'));

// AUTH
const Login = lazy(() => import('components/page/Auth/Login'));
const Register = lazy(() => import('components/page/Auth/Register'));
const Logout = lazy(() => import('components/page/Auth/Logout'));

// CONTACT
const ShowContact = lazy(() => import('components/page/Contact/ShowContact'));
const AddContact = lazy(() => import('components/page/Contact/AddContact'));
const EditContact = lazy(() => import('components/page/Contact/EditContact'));

const useStyles = makeStyles((theme) => ({
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
    // padding: theme.spacing(3),
    padding: '57px',
  },
}));

function App(state) {
  const classes = useStyles();
  const theme = createMuiTheme({
    palette: {
      type: state.Theme.type
    }
  });
  
  return (
    <MuiThemeProvider theme={theme}>
      <ToastProvider
        placement="bottom-center"
      >
        <Router>
          <Suspense fallback={<Loading />}>
            <div className="container">
              <MainMenu />
              <main className={classes.content}>
                <div className={classes.toolbar} />
                <Switch>
                <Route
                  path={home()}
                  render={props => <RequireAuth {...props} Component={Home} />}
                />
                <Route path={login()}
                  component={ Login }
                />
                <Route path={register()}
                  component={ Register }
                />
                <Route path={logout()}
                  render={props => <RequireAuth {...props} Component={Logout} />}
                />
                <Route path={showContact()}
                  render={props => <RequireAuth {...props} Component={ShowContact} />}
                />
                <Route path={addContact()}
                  render={props => <RequireAuth {...props} Component={AddContact} />}
                />
                <Route path={editContact()}
                  render={props => <RequireAuth {...props} Component={EditContact} />}
                />
              </Switch>
              </main>
            </div>
          </Suspense>
        </Router>
      </ToastProvider>
    </MuiThemeProvider>
  );
}

function mapStateToProps(state) {
  return state
};

export default connect(mapStateToProps)(App);
