import {
  Autocomplete,
  CircularProgress,
  TextField,
  TextFieldProps,
} from "@mui/material";
import React, { FC } from "react";

interface IData {
  name: string;
  id: number;
}

type IAutocompleteAsync = TextFieldProps & { loading: boolean; data?: any[] };

const AutocompleteAsync: FC<IAutocompleteAsync> = (props) => {
  const { data, loading } = props;
  const [open, setOpen] = React.useState(false);
  const [options, setOptions] = React.useState<readonly IData[]>([]);

  React.useEffect(() => {
    let active = true;

    if (!loading) {
      return undefined;
    }

    (async () => {
      if (active && data) {
        setOptions([...data]);
      }
    })();

    return () => {
      active = false;
    };
  }, [loading]);

  React.useEffect(() => {
    if (!open) {
      setOptions([]);
    }
  }, [open]);

  return (
    <Autocomplete
      id="asynchronous-demo"
      open={open}
      onOpen={() => {
        setOpen(true);
      }}
      onClose={() => {
        setOpen(false);
      }}
      isOptionEqualToValue={(option, value) => option.id === value.id}
      getOptionLabel={(option) => option.name}
      options={options}
      loading={loading}
      renderInput={(params) => (
        <TextField
          {...props}
          {...params}
          InputProps={{
            ...params.InputProps,
            endAdornment: (
              <React.Fragment>
                {loading ? (
                  <CircularProgress color="inherit" size={20} />
                ) : null}
                {params.InputProps.endAdornment}
              </React.Fragment>
            ),
          }}
        />
      )}
    />
  );
};

export default AutocompleteAsync;
