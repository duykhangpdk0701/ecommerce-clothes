import FormGroup from "@mui/material/FormGroup";
import IBrand from "@/interfaces/Brand";
import React, { FC, Fragment } from "react";
import ListProductdSideBarBrandItem from "./item";
import List from "@mui/material/List";
import ListItem from "@mui/material/ListItem";
import ListItemText from "@mui/material/ListItemText";
import { useFormContext, Controller } from "react-hook-form";

interface IListProductdSideBarBrand {
  data?: IBrand[];
}

const ListProductdSideBarBrand: FC<IListProductdSideBarBrand> = (props) => {
  const { data } = props;
  const { control } = useFormContext();

  return (
    <>
      <h6 className="text-sm font-semibold mb-2.5">Brand</h6>
      <Controller
        name="brand"
        control={control}
        render={({ field }) => (
          <List disablePadding>
            {data?.map((item) => (
              <ListItem
                key={item.id}
                disablePadding
                onClick={(e) => field.onChange(item.id)}
                className="cursor-pointer py-1.5"
              >
                <ListItemText>
                  <span
                    className={`text-sm ${
                      field.value === item.id
                        ? "text-color-blue font-semibold"
                        : "text-color-gray"
                    }`}
                  >
                    {item.name}
                  </span>
                </ListItemText>
              </ListItem>
            ))}
          </List>
        )}
      />
    </>
  );
};

export default ListProductdSideBarBrand;
