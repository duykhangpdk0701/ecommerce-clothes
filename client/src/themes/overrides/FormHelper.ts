import { Theme } from "@mui/material";

export default function FormHelperText(theme: any) {
  return {
    MuiFormHelperText: {
      styleOverrides: {
        root: {
          marginTop: "8px",
          marginLeft: "14px",
          marginRight: "14px",
        },
      },
    },
  };
}
