import React, { useEffect, useState } from 'react';
import { useDispatch, connect } from "react-redux";
import { useTranslate } from 'react-redux-multilingual'
import { useHistory } from 'react-router-dom';
import { useToasts } from 'react-toast-notifications'
import DeleteIcon from '@material-ui/icons/Delete';
import CreateIcon from '@material-ui/icons/Create';
import IconButton from "@material-ui/core/IconButton";
import AddIcon from "@material-ui/icons/Add";
import MUIDataTable from "mui-datatables";
import { 
  CircularProgress,
  Typography,
  Tooltip,
  MuiThemeProvider,
  createMuiTheme } from '@material-ui/core';

import SkeletonTable from 'components/UI/skeleton/SkeletonTable';
import { addContact, editContact } from 'routes/routes';
import { ListContactService, DeleteContactService } from "store/Contact/ContactService";
import { muiTableLanguageConfig } from 'utils/muiTableLanguageConfig'

const container = {
  border: "0px solid rgba(255, 255, 255, 1)",
  boxShadow: "0px 0px 20px rgba(0, 0, 0, .1)",
  borderRadius: "4px",
  backgroundColor: "white",
  display: "block",
  marginTop: '3rem',
  marginBottom: '3rem'
}

const ShowContact = (state) => {
  const t = useTranslate();
  const history = useHistory();
  const dispatch = useDispatch();
  const { addToast } = useToasts();
  const [initialLoading, setInitialLoading] = useState(true);
  const [loading, setloading] = useState(false);

  useEffect(() => {
    ListContactService(dispatch, addToast, t);
    setTimeout(() => {
      setInitialLoading(false);
    }, 1000);
  }, [dispatch, addToast, setloading]);

  const handleEdit = (data) => {
    history.push({
      pathname: editContact(),
      state: { id: data.rowData[0] }
    })
  }

  const handleDelete = (data) => {
    const values = {
      id: data.rowData[0]
    }
    setloading(true);
    DeleteContactService(values, setloading, addToast, dispatch, t);
  }

  const handleAddContact = () => {
    history.push(addContact());
  }

  const columns = [
    {
      name: "id",
      label: "ID",
      options: {
        display: false,
        filter: false,
        sort: false,
        viewColumns: false
      }
    },
    {
      name: "name",
      label: t("Contact.ShowContact.name"),
      options: {
        filter: false,
        sort: true
      }
    },
    {
      name: "email",
      label: t("Contact.ShowContact.email"),
      options: {
        filter: false,
        sort: true,
      }
    },
    {
      name: "phone",
      label: t("Contact.ShowContact.phone"),
      options: {
        filter: false,
        sort: false,
      }
    },
    {
      name: "actions",
      label: t("Contact.ShowContact.action"),
      options: {
        filter: false,
        sort: false,
        print: false,
        download: false,
        empty: true,
        customBodyRender: (value, tableMeta, updateValue) => {
          return (
            <>
              <Tooltip disabled={state.Connection.status === "offline" ? true : false} title={t("Contact.ShowContact.tooltip.edit")}>
                <IconButton disabled={state.Connection.status === "offline" ? true : false} style={{ backgroundColor: '' }} onClick={handleEdit.bind(this, tableMeta)}>
                  <CreateIcon color="disabled" style={{ "color": state.Connection.status === "offline" ? "" : "#007bff" }} />
                </IconButton>
              </Tooltip>
              <Tooltip disabled={state.Connection.status === "offline" ? true : false} title={t("Contact.ShowContact.tooltip.delete")}>
                <IconButton style={{ backgroundColor: '' }} onClick={handleDelete.bind(this, tableMeta)}>
                  <DeleteIcon color="disabled" style={{"color": state.Connection.status === "offline" ? "" : "#dc3545"}} />
                </IconButton>
              </Tooltip>
            </>
          );
        }
      }
    }
  ];

  const options = {
    // filterType: 'checkbox',
    filter: false,
    rowsPerPageOptions: [10, 20],
    elevation: 4,
    // rowsPerPage: 10,
    customToolbar: () => {
      return (
        <Tooltip disabled={state.Connection.status === "offline" ? true : false} title={t("Contact.ShowContact.tooltip.add")}>
          <IconButton style={state.Connection.status === "offline" ? { "color": "", backgroundColor: '' } : { backgroundColor: '#28a745', "color": "#28a745" }} onClick={handleAddContact}>
            <AddIcon style={{ "color": state.Connection.status === "offline" ? "" : "#fff" }} />
          </IconButton>
        </Tooltip>
      );
    },
    textLabels: muiTableLanguageConfig(t),
    responsive: 'scrollMaxHeight',
  };

  const theme = createMuiTheme({
    palette: { type: state.Theme.type },
    // typography: { useNextVariants: true },
  });
  
  if (initialLoading) {
    return (
      <SkeletonTable count={state.Contact.contacts.length} />
    );
  } else {
    return (
      <div style={container}>
        <MuiThemeProvider theme={theme}>
          <MUIDataTable
            key="es"
            title={<Typography component="h1" variant="h3">
                    {loading && <CircularProgress size={28} style={{ marginLeft: 15, position: 'relative', top: 4 }} />}
                  </Typography>}
            data={state.Contact.contacts}
            columns={columns}
            options={options}
          />
        </MuiThemeProvider>
      </div>
    );
  }
}

function mapStateToProps(state) {
  return state
};

export default connect(mapStateToProps)(ShowContact);
