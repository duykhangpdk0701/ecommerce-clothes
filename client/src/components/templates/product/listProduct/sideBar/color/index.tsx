import React, { FC, Fragment } from "react";
import IColor from "@/interfaces/Color";
import Checkbox from "@mui/material/Checkbox";
import FormControl from "@mui/material/FormControl";
import FormControlLabel from "@mui/material/FormControlLabel";
import CircleIcon from "@mui/icons-material/Circle";
import Box from "@mui/material/Box";
import CheckCircleIcon from "@mui/icons-material/CheckCircle";

import { useFormContext, Controller } from "react-hook-form";

interface IListProductdSideBarColor {
  data?: IColor[];
}

const ListProductdSideBarColor: FC<IListProductdSideBarColor> = (props) => {
  const { data } = props;
  const { control } = useFormContext();

  return (
    <>
      <h6 className="text-sm font-semibold mb-2.5">Color</h6>

      <Controller
        name="itemColor"
        control={control}
        render={({ field: { value, onChange } }) => (
          <FormControl className="flex flex-row" component="fieldset">
            {data?.map((item, index) => (
              <Checkbox
                key={item.id}
                icon={
                  <CircleIcon
                    sx={{ color: item.value }}
                    className="w-6 h-6 rounded-full border border-solid border-gray-300"
                  />
                }
                checkedIcon={
                  <CheckCircleIcon
                    sx={{ color: item.value }}
                    className="w-6 h-6 rounded-full border border-solid border-gray-300"
                  />
                }
                value={item.id === value?.[index]}
                checked={value.some(
                  (formOption: number) => formOption === item.id
                )}
                onChange={(e) => {
                  const valueCopy = [...value];
                  if (e.target.checked) {
                    valueCopy.push(item.id); // append to array
                  } else {
                    const idx = valueCopy.findIndex(
                      (formOption) => formOption === item.id
                    );
                    valueCopy.splice(idx, 1); // remove from array
                  }
                  onChange(valueCopy); // update form field with new array
                }}
              />
            ))}
          </FormControl>
        )}
      />
    </>
  );
};

export default ListProductdSideBarColor;
