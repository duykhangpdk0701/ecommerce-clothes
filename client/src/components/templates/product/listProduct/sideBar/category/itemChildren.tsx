import ListItem from "@mui/material/ListItem";
import ListItemText from "@mui/material/ListItemText";
import React, { FC } from "react";
import { Controller, useFormContext } from "react-hook-form";

interface IListProductSideBarItemCategoryItemChildren {
  name: string;
  id: number;
}

const ListProductSideBarItemCategoryItemChildren: FC<
  IListProductSideBarItemCategoryItemChildren
> = (props) => {
  const { name, id } = props;
  const { control } = useFormContext();

  return (
    <Controller
      control={control}
      name="category"
      render={({ field }) => (
        <ListItem
          disablePadding
          className="py-1.5 cursor-pointer"
          onClick={(e) => field.onChange(id)}
        >
          <ListItemText>
            <span
              className={`text-sm ${
                field.value === id
                  ? "text-color-blue font-semibold"
                  : "text-color-gray"
              }`}
            >
              {name}
            </span>
          </ListItemText>
        </ListItem>
      )}
    />
  );
};

export default ListProductSideBarItemCategoryItemChildren;
