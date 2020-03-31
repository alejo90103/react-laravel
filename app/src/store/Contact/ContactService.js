import { contactListUrl, addContactUrl, updateContactUrl , deleteContactUrl } from 'routes/api';

import { headers } from 'config/headers';
import { ListContactAction, AddContactAction, UpdateContactAction, DeleteContactAction } from "store/Contact/ContactAction";
import { showContact } from 'routes/routes';

export const ListContactService = async function (dispatch, addToast, t) {
  try {
    const requestOptions = {
      method: 'GET',
      headers: headers()
    }

    fetch(contactListUrl, requestOptions)
      .then(async response => {
        const data = await response.json();

        // check for error response
        if (!response.ok) {
          // get error message from body or default to response status
          const error = (data && data.message) || response.status;
          return Promise.reject(error);
        }

        if (response.status === 200) {
          ListContactAction(dispatch, data);
        }

      })
      .catch(error => {
        addToast(t("Contact.Service.list.error.fetching"), {
          appearance: 'error',
          autoDismiss: true,
        });
        console.error('There was an error!', error);
      });
  } catch (e) {
    console.log(e);
  }
}

export const AddContactService = async function (values, setLoading, addToast, dispatch, t) {
  try {
    const requestOptions = {
      method: 'POST',
      headers: headers(),
      body: JSON.stringify({
        name: values.name,
        phone: values.phone,
        email: values.email
      })
    }

    fetch(addContactUrl, requestOptions)
      .then(async response => {
        const data = await response.json();

        // check for error response
        if (!response.ok) {
          // get error message from body or default to response status
          const error = (data && data.message) || response.status;
          return Promise.reject(error);
        }

        if (response.status === 201) {
          setLoading(false);
          addToast(t("Contact.Service.add.success"), {
            appearance: 'success',
            autoDismiss: true,
          });
          AddContactAction(dispatch, data);
        }

      })
      .catch(error => {
        setLoading(false);
        addToast(error, {
          appearance: 'error',
          autoDismiss: true,
        });
        console.error('There was an error!', error);
      });
  } catch (e) {
    setLoading(false);
    console.log(e);
  }
}

export const UpdateContactService = async function (values, setLoading, addToast, history, dispatch, t) {
  try {
    const requestOptions = {
      method: 'PUT',
      headers: headers(),
      body: JSON.stringify({
        id: values.id,
        name: values.name,
        phone: values.phone,
        email: values.email
      })
    }

    fetch(updateContactUrl, requestOptions)
      .then(async response => {
        const data = await response.json();

        // check for error response
        if (!response.ok) {
          // get error message from body or default to response status
          const error = (data && data.message) || response.status;
          return Promise.reject(error);
        }

        if (response.status === 200) {
          setLoading(false);
          addToast(t("Contact.Service.edit.success"), {
            appearance: 'success',
            autoDismiss: true,
          });
          UpdateContactAction(dispatch, data);
          history.push(showContact());
        }

      })
      .catch(error => {
        setLoading(false);
        addToast(`Email ${error}`, {
          appearance: 'error',
          autoDismiss: true,
        });
        console.error('There was an error!', error);
      });
  } catch (e) {
    setLoading(false);
    console.log(e);
  }
}

export const DeleteContactService = async function (values, setloading, addToast, dispatch, t) {
  try {
    const requestOptions = {
      method: 'POST',
      headers: headers(),
      body: JSON.stringify({
        id: values.id
      })
    }

    fetch(deleteContactUrl, requestOptions)
      .then(async response => {
        const data = await response.json();

        // check for error response
        if (!response.ok) {
          // get error message from body or default to response status
          const error = (data && data.message) || response.status;
          return Promise.reject(error);
        }

        if (response.status === 201) {
          DeleteContactAction(dispatch, data);
          addToast(t("Contact.Service.remove.success"), {
            appearance: 'success',
            autoDismiss: true,
          });
          setloading(false);
        }

      })
      .catch(error => {
        addToast(t("Contact.Service.remove.error.remove"), {
          appearance: 'error',
          autoDismiss: true,
        });
        setloading(false);
        console.error('There was an error!', error);
      });
  } catch (e) {
    setloading(false);
    console.log(e);
  }
}