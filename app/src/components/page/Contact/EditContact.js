import React, { useState, useEffect } from "react";
import { useHistory } from "react-router-dom";
import { useToasts } from 'react-toast-notifications'
import { useDispatch, connect } from "react-redux";
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

import { UpdateContactService } from 'store/Contact/ContactService';

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

function validateForm(values) {
  const errors = {};
  if (!values.name) {
    errors.name = 'El nombre es requerido';
  }
  if (!values.email) {
    errors.email = 'El correo es requerido';
  }
  if (!values.phone) {
    errors.phone = 'El teléfono es requerido';
  }
  return errors;
}

const EditContact = (state) => {
  const classes = useStyles();
  const dispatch = useDispatch();
  const { addToast } = useToasts();
  const history = useHistory();
  const [loading, setLoading] = useState(false);
  const formik = '';
  const [contact, setContact] = useState({
    id: '',
    name: '',
    email: '',
    phone: ''
  });

  useEffect(() => {
    if (history.location.state !== undefined) {
      if (history.location.state.id) {
        const contactFind = state.Contact.contacts.filter(contact => contact.id === history.location.state.id);
        if (contactFind.length > 0) {
          setContact({
            id: contactFind[0].id,
            name: contactFind[0].name,
            email: contactFind[0].email,
            phone: contactFind[0].phone
          });
        } else {
          console.log('Error');
        }
      }
    }
  }, [history, state]);
  

  function handleSubmit(values) {
    setLoading(true);
    UpdateContactService(values, setLoading, addToast, history, dispatch);
  }

  return (
    <Container component="main" maxWidth="xs">
      <CssBaseline />
      <Paper elevation={3}>
        <div className={classes.paper}>
          <Typography component="h1" variant="h2">
            Edit Contact
          </Typography>
          <Formik initialValues={contact} validate={validateForm} onSubmit={handleSubmit} enableReinitialize={true}>
            {({ values, errors, touched, handleChange, handleSubmit }) => (
              <form className={classes.form} onSubmit={handleSubmit}>
                <TextField
                  variant="outlined"
                  margin="normal"
                  autoFocus
                  fullWidth
                  name="name"
                  label="Name"
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
                  label="Email"
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
                  label="Phone"
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
                  Edit
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

  //   <div>
  //     <Row className="justify-content-md-center" style={rowStyled()}>
  //       <Jumbotron fluid style={jumbotronStyled()} className="col-5">
  //         <Container style={containerStyled()}>
  //           <h1 style={{ 'textAlign': 'center' }}>Editar Contacto</h1>
  //           <br />
  //           <Formik initialValues={contact} validate={validateForm} onSubmit={handleSubmit} enableReinitialize={true}>
  //             {({ values, errors, touched, handleChange, handleSubmit }) => (
  //               <Form onSubmit={handleSubmit}>
  //                 <Form.Group controlId="formBasicName">
  //                   <Form.Label>Nombre</Form.Label>
  //                   <Form.Control name="name" type="name" placeholder="Nombre" value={values.name} onChange={handleChange} />
  //                   {errors.name && touched.name && <p style={errorStyled()}>{errors.name}</p>}
  //                 </Form.Group>
  //                 <Form.Group controlId="formBasicEmail">
  //                   <Form.Label>Correo</Form.Label>
  //                   <Form.Control name="email" type="email" placeholder="Correo" value={values.email} onChange={handleChange} />
  //                   {errors.email && touched.email && <p style={errorStyled()}>{errors.email}</p>}
  //                 </Form.Group>
  //                 <Form.Group controlId="formBasicPhone">
  //                   <Form.Label>Teléfono</Form.Label>
  //                   <Form.Control name="phone" type="phone" placeholder="Teléfono" value={values.phone} onChange={handleChange} />
  //                   {errors.phone && touched.phone && <p style={errorStyled()}>{errors.phone}</p>}
  //                 </Form.Group>
  //                 <Form.Group controlId="formBasicButton" style={{ 'textAlign': 'center' }}>
  //                   <Button variant="success" type="submit">
  //                     {loading ? <Spinner as="span" animation="grow" size="sm" role="status" aria-hidden="true" /> : <></>}
  //                   Editar
  //                 </Button>
  //                 </Form.Group>
  //               </Form>
  //             )}
  //           </Formik>
  //         </Container>
  //       </Jumbotron>
  //     </Row>
  //   </div>
  );
}

function mapStateToProps(state) {
  return state
};

export default connect(mapStateToProps)(EditContact);
