import Autocomplete from "@mui/material/Autocomplete";
import CircularProgress from "@mui/material/CircularProgress";
import TextField from "@mui/material/TextField";
import { TextFieldProps } from "@mui/material/TextField";
import React, { FC, useEffect, useState } from "react";

interface IData {
  name: string;
  id: number;
}

type IAutocompleteAsync = TextFieldProps & {
  loading: boolean;
  data?: any[];
  formValue?: number;
  onChange?: (e: any) => void;
};

const AutocompleteAsync: FC<IAutocompleteAsync> = (props) => {
  const { formValue, data, loading, onChange } = props;
  const [option, setOption] = useState<IData[]>([]);

  const [inputValue, setInputValue] = useState<IData | null>();

  useEffect(() => {
    if (formValue == undefined) {
      setInputValue(null);
    } else setInputValue(option.find((item) => item.id === formValue));
  }, [formValue]);

  useEffect(() => {
    if (data) {
      setOption(data.map((item) => ({ id: item.id, name: item.name })));
    }
  }, [data]);

  return (
    <Autocomplete
      value={inputValue || null}
      disabled={loading}
      onChange={(event, value) => {
        if (!value) {
          setInputValue(null);
          if (onChange) onChange(undefined);
        } else {
          setInputValue(value);
          if (onChange) onChange(value?.id);
        }
      }}
      isOptionEqualToValue={(option, value) => option.id == value.id || !value}
      getOptionLabel={(option) => (option.name ? option.name : "")}
      options={option}
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
