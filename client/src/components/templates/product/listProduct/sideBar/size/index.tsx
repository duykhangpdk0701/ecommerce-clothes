import ISize from "@/interfaces/Size";
import Typography from "@mui/material/Typography";
import Checkbox from "@mui/material/Checkbox";
import FormControl from "@mui/material/FormControl";
import FormControlLabel from "@mui/material/FormControlLabel";
import { FC } from "react";
import { Controller, useFormContext } from "react-hook-form";

interface IListProductSideBarSize {
  data?: ISize[];
}

const ListProductSideBarSize: FC<IListProductSideBarSize> = (props) => {
  const { data } = props;
  const { control } = useFormContext();

  return (
    <>
      <h6 className="text-sm font-semibold mb-2.5">Item Size</h6>
      <Controller
        name="itemSize"
        control={control}
        render={({ field: { value, onChange } }) => (
          <FormControl component="fieldset">
            {data?.map((item) => (
              <FormControlLabel
                key={item.id}
                label={
                  <Typography
                    variant="body1"
                    className="text-sm text-color-gray"
                  >
                    {item.value}
                  </Typography>
                }
                value={item.id}
                control={
                  <Checkbox
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
                    size="small"
                  />
                }
              />
            ))}
          </FormControl>
        )}
      />
    </>
  );
};

export default ListProductSideBarSize;
