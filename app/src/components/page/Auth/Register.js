import React, { useState } from "react";
import { useHistory, Link } from "react-router-dom";
import { useToasts } from 'react-toast-notifications'
import { Formik } from "formik";
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

import { login } from 'routes/routes'
import { RegisterService } from 'store/Auth/AuthService';

const useStyles = makeStyles((theme, loading) => ({
  error: {
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
  firstName: '',
  lastName: '',
  email: '',
  password: '',
  confirm_password: ''
}

function validateForm(values) {
  const errors = {};
  if (!values.firstName) {
    errors.firstName = 'El nombre es requerido';
  }
  if (!values.lastName) {
    errors.lastName = 'Los apellidos son requeridos';
  }
  if (!values.email) {
    errors.email = 'El correo es requerido';
  }
  if (!values.password) {
    errors.password = 'La contraseña es requerida';
  }
  if (!values.confirm_password) {
    errors.confirm_password = 'La confirmación de la contraseña es requerida';
  }
  return errors;
}

const Register = () => {
  const { addToast } = useToasts();
  const history = useHistory();
  const [loading, setLoading] = useState(false);
  const classes = useStyles();

  function handleSubmit(values) {
    if (values.password === values.confirm_password) {
      const sendValues = {
        name: values.firstName + '' + values.lastName,
        email: values.email,
        password: values.password,
        confirm_password: values.confirm_password
      }
      setLoading(true);
      RegisterService(sendValues, setLoading, addToast, history);
    } else {
      addToast('Las contraseñas no coinciden', {
        appearance: 'error',
        autoDismiss: true,
      });
      setLoading(false);
    }
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
          Sign up
        </Typography>
        <Formik initialValues={initialValues} validate={validateForm} onSubmit={handleSubmit}>
        {({ values, errors, touched, handleChange, handleSubmit }) => (
          <form className={classes.form} onSubmit={handleSubmit}>
            <Grid container spacing={2}>
              <Grid item xs={12} sm={6}>
                <TextField
                  autoComplete="fname"
                  name="firstName"
                  variant="outlined"
                  fullWidth
                  id="firstName"
                  label="First Name"
                  autoFocus
                  aria-describedby="firstName-helper"
                  value={values.firstName}
                  onChange={handleChange}
                />
                {errors.firstName && touched.firstName && <FormHelperText id="firstName-helper">{errors.firstName}</FormHelperText>}
              </Grid>
              <Grid item xs={12} sm={6}>
                <TextField
                  variant="outlined"
                  fullWidth
                  id="lastName"
                  label="Last Name"
                  name="lastName"
                  autoComplete="lname"
                  aria-describedby="lastName-helper"
                  value={values.lastName}
                  onChange={handleChange}
                />
                {errors.lastName && touched.lastName && <FormHelperText id="lastName-helper">{errors.lastName}</FormHelperText>}
              </Grid>
              <Grid item xs={12}>
                <TextField
                  variant="outlined"
                  fullWidth
                  id="email"
                  label="Email Address"
                  name="email"
                  aria-describedby="email-helper"
                  value={values.email}
                  onChange={handleChange}
                />
                {errors.email && touched.email && <FormHelperText id="email-helper">{errors.email}</FormHelperText>}
              </Grid>
              <Grid item xs={12} sm={6}>
                <TextField
                  variant="outlined"
                  fullWidth
                  name="password"
                  label="Password"
                  type="password"
                  id="password"
                  aria-describedby="password-helper"
                  value={values.password}
                  onChange={handleChange}
                />
                {errors.password && touched.password && <FormHelperText id="password-helper">{errors.password}</FormHelperText>}
              </Grid>
              <Grid item xs={12} sm={6}>
                <TextField
                  variant="outlined"
                  fullWidth
                  name="confirm_password"
                  label="Confirm Password"
                  type="password"
                  id="confirm_password"
                  aria-describedby="confirm-password-helper"
                  value={values.confirm_password}
                  onChange={handleChange}
                />
                {errors.confirm_password && touched.confirm_password && <FormHelperText id="confirm-password-helper">{errors.confirm_password}</FormHelperText>}
              </Grid>
              {/* <Grid item xs={12}>
                <FormControlLabel
                  control={<Checkbox value="allowExtraEmails" color="primary" />}
                  label="I want to receive inspiration, marketing promotions and updates via email."
                />
              </Grid> */}
            </Grid>
            <Button
              type="submit"
              fullWidth
              variant="contained"
              color="primary"
              className={classes.submit}
            >
              Sign Up
            </Button>
            <Grid container justify="flex-end">
            <Grid item>
              <Link to={login()} variant="body2">
                Already have an account? Sign in
              </Link>
            </Grid>
          </Grid>
          </form>
        )}
        </Formik>
      </div>
      <Box mt={5}>
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
  );
}

export default Register;
