import React, { useState } from "react";
import { useHistory } from "react-router-dom";
import { useToasts } from 'react-toast-notifications'
import { useDispatch } from "react-redux";
import { useTranslate } from 'react-redux-multilingual'
import { Formik } from "formik";
import {
  Container,
  Grid,
  Box,
  Avatar,
  Paper,
  Button,
  TextField,
  FormHelperText,
  CircularProgress,
  Typography,
  CssBaseline,
  makeStyles
} from '@material-ui/core';

import { AddContactService } from 'store/Contact/ContactService';

const useStyles = makeStyles((theme) => ({
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
    padding: '1rem'
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
  name: '',
  email: '',
  phone: ''
}

const AddContact = () => {
  const t = useTranslate();
  const classes = useStyles();
  const dispatch = useDispatch();
  const { addToast } = useToasts();
  const history = useHistory();
  const [loading, setLoading] = useState(false);

  function validateForm(values) {
    const errors = {};
    if (!values.name) {
      errors.name = t('Contact.AddContact.error.validate.name');
    }
    if (!values.email) {
      errors.email = t('Contact.AddContact.error.validate.email');
    }
    if (!values.phone) {
      errors.phone = t('Contact.AddContact.error.validate.phone');
    }
    return errors;
  }

  function handleSubmit(values) {
    setLoading(true);
    AddContactService(values, setLoading, addToast, dispatch, t);
    values = initialValues;
  }

  return (
    <Container component="main" maxWidth="xs">
      <CssBaseline />
      <Paper elevation={3}>
        <div className={classes.paper}>
          <Typography component="h1" variant="h2">
            {t('Contact.AddContact.title')}
          </Typography>
          <Formik initialValues={initialValues} validate={validateForm} onSubmit={handleSubmit}>
            {({ values, errors, touched, handleChange, handleSubmit }) => (
              <form className={classes.form} onSubmit={handleSubmit}>
                <TextField
                  variant="outlined"
                  margin="normal"
                  autoFocus
                  fullWidth
                  name="name"
                  label={t('Contact.AddContact.name')}
                  type="text"
                  id="name"
                  aria-describedby="name-helper"
                  value={values.name}
                  onChange={handleChange}
                />
                {errors.name && touched.name && <FormHelperText id="password-helper">{errors.name}</FormHelperText>}
                <TextField
                  variant="outlined"
                  margin="normal"
                  fullWidth
                  id="email"
                  label={t('Contact.AddContact.email')}
                  name="email"
                  type="email"
                  aria-describedby="email-helper"
                  value={values.email}
                  onChange={handleChange}
                />
                {errors.email && touched.email && <FormHelperText id="email-helper">{errors.email}</FormHelperText>}
                <TextField
                  variant="outlined"
                  margin="normal"
                  fullWidth
                  name="phone"
                  label={t('Contact.AddContact.phone')}
                  type="name"
                  id="phone"
                  aria-describedby="phone-helper"
                  value={values.phone}
                  onChange={handleChange}
                />
                {errors.phone && touched.phone && <FormHelperText id="phone-helper">{errors.phone}</FormHelperText>}
                <Button
                  type="submit"
                  fullWidth
                  variant="contained"
                  color="primary"
                  className={classes.submit}
                >
                  {t('Contact.AddContact.addButton')}
                </Button>
                {/* <Grid container>
                  <Grid item xs>
                    <Link to='' variant="body2">
                      Forgot password?
                    </Link>
                  </Grid>
                  <Grid item>
                    <Link to={register} variant="body2">
                      {"Don't have an account? Sign Up"}
                    </Link>
                  </Grid>
                </Grid> */}
              </form>
            )}
          </Formik>
        </div>
      </Paper>
    </Container>
  );
}

export default AddContact;
