import { createTheme } from "@mui/material/styles";

const theme = createTheme({
  typography: {
    button: {
      textTransform: "none",
    },
  },

  palette: {
    text: { primary: "#2B3445" },
  },

  components: {
    // Name of the component
    MuiButton: {
      styleOverrides: {
        // Name of the slot
        root: {
          // Some CSS
          textTransform: "none",
          lineHeight: 2.3,
        },
      },
    },

    MuiInputLabel: {
      styleOverrides: {
        root: {
          marginBottom: "8px",
          color: "#4B566B",
          fontSize: "12px",
          fontWeight: "600",
        },
      },
    },
    MuiFormHelperText: {
      styleOverrides: {
        root: {
          marginTop: "8px",
          marginLeft: "14px",
          marginRight: "14px",
        },
      },
    },

    MuiOutlinedInput: {
      styleOverrides: {
        input: {
          paddingTop: "12px",
          paddingBottom: "12px",
          paddingLeft: "14px",
          paddingRight: "14px",
        },
        root: {
          fontSize: "14px",
        },
      },
    },

    MuiInputBase: {
      styleOverrides: {
        root: {},
      },
    },

    MuiPaper: {
      styleOverrides: {
        elevation1: {
          boxShadow: "rgb(43 52 69 / 10%) 0px 4px 16px",
        },
      },
    },
    MuiAutocomplete: {
      styleOverrides: {
        inputRoot: {
          paddingTop: "4px",
          paddingBottom: "4px",
        },

        option: {
          fontSize: "14px",
        },
        loading: {
          fontSize: "14px",
        },
        popper: {
          fontSize: "14px",
        },
        root: {
          fontSize: "14px",
        },
      },
    },
    MuiListItemText: {
      styleOverrides: {
        root: {
          textTransform: "none",
        },
      },
    },
  },
});

export default theme;
