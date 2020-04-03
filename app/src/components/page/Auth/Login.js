import React, { useState } from "react";
import { useHistory, Link } from "react-router-dom";
import { useToasts } from 'react-toast-notifications'
import { connect, useDispatch } from "react-redux";
import { Formik } from "formik";
import { useTranslate } from 'react-redux-multilingual'
import LockOutlinedIcon from '@material-ui/icons/LockOutlined';
import {
  Container,
  Grid,
  Box,
  Avatar,
  Button,
  TextField,
  FormControlLabel,
  FormHelperText,
  Checkbox,
  CircularProgress,
  Typography,
  CssBaseline,
  makeStyles
} from '@material-ui/core';

import { register, login } from 'routes/routes'
import { LogginService } from 'store/Auth/AuthService';

const useStyles = makeStyles((theme) => ({
  error : {
    color: 'red',
    fontSize: '12px'
  },
  progress: {
    color: theme.palette.success.main,
    position: 'absolute',
    zIndex: 1
  },
  paper: {
    marginTop: theme.spacing(8),
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
  },
  avatar: {
    margin: theme.spacing(1),
    backgroundColor: theme.palette.secondary.main,
  },
  avatarSuccess: {
    margin: theme.spacing(1),
    backgroundColor: theme.palette.success.main,
  },
  form: {
    width: '100%',
    marginTop: theme.spacing(1),
  },
  submit: {
    margin: theme.spacing(3, 0, 2),
  },
}));

const initialValues = {
  email: '',
  password: ''
}

const Login = function (state) {
  const t = useTranslate();
  const dispatch = useDispatch();
  const { addToast } = useToasts();
  const history = useHistory();
  const [loading, setLoading] = useState(false);
  const classes = useStyles();

  function validateForm(values) {
    const errors = {};
    if (!values.email) {
      errors.email = t('Auth.Login.error.validate.email');
    }
    if (!values.password) {
      errors.password = t('Auth.Login.error.validate.password');
    }
    return errors;
  }

  function handleSubmit(values) {
    setLoading(true);
    LogginService(values, setLoading, addToast, history, dispatch, t);
  }

  return (
    <Container component="main" maxWidth="xs">
      <CssBaseline />
      <div className={classes.paper}>
        {loading ? 
          <Avatar className={classes.avatarSuccess}>
            <LockOutlinedIcon />
          </Avatar>
          :
          <Avatar className={classes.avatar}>
            <LockOutlinedIcon />
          </Avatar>
        }
        {loading && <CircularProgress size={56} className={classes.progress} />}
        <Typography component="h1" variant="h5">
          {t('Auth.Login.signIn')}
        </Typography>
        <Formik initialValues={initialValues} validate={validateForm} onSubmit={handleSubmit}>
        {({ values, errors, touched, handleChange, handleSubmit }) => (
          <form className={classes.form} onSubmit={handleSubmit}>
            <TextField
              variant="outlined"
              margin="normal"
              fullWidth
              id="email"
              label={t('Auth.Login.email')}
              name="email"
              type="email"
              autoComplete="email"
              autoFocus
              aria-describedby="email-helper"
              value={values.email}
              onChange={handleChange}
            />
            {errors.email && touched.email && <FormHelperText id="email-helper">{errors.email}</FormHelperText>}
            <TextField
              variant="outlined"
              margin="normal"
              fullWidth
              name="password"
              label={t('Auth.Login.password')}
              type="password"
              id="password"
              autoComplete="current-password"
              aria-describedby="password-helper"
              value={values.password}
              onChange={handleChange}
            />
            {errors.password && touched.password && <FormHelperText id="password-helper">{errors.password}</FormHelperText>}
            <FormControlLabel
              control={<Checkbox value="remember" color="primary" />}
              label={t('Auth.Login.remember')}
            />
            <Button
              type="submit"
              fullWidth
              variant="contained"
              color="primary"
              className={classes.submit}
              disabled={state.Connection.status === "offline" ? true : false}
            >
              {t('Auth.Login.signInButton')}
            </Button>
            <Grid container>
              <Grid item xs>
                <Link to='' variant="body2">
                  {t('Auth.Login.forgot')}
                </Link>
              </Grid>
              <Grid item>
                <Link to={register} variant="body2">
                  {t('Auth.Login.register')}
                </Link>
              </Grid>
            </Grid>
          </form>
        )}
        </Formik>
      </div>
      <Box mt={8}>
        <Typography variant="body2" color="textSecondary" align="center">
          {'Copyright © '}
          <a color="inherit" href="https://codeals.es/">
            Codeals
          </a>{' '}
          {new Date().getFullYear()}
          {'.'}
        </Typography>
      </Box>
    </Container>
  )
}

function mapStateToProps(state) {
  return state
};

export default connect(mapStateToProps)(Login);