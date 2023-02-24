import { TEXT_COLOR_GRAY } from "@/styles/color";
//material icon
import ExpandMore from "@mui/icons-material/ExpandMore";
import ChevronRight from "@mui/icons-material/ChevronRight";
//material mui component
import Collapse from "@mui/material/Collapse";
import List from "@mui/material/List";
import ListItem from "@mui/material/ListItem";
import ListItemText from "@mui/material/ListItemText";

import React, { FC, Fragment, useState } from "react";
import ListProductSideBarItemCategoryItemChildren from "./itemChildren";
import ICategory from "@/interfaces/Category";

interface IListProductSideBarItemCategoryItem {
  data: ICategory;
}

const ListProductSideBarItemCategoryItem: FC<
  IListProductSideBarItemCategoryItem
> = (props) => {
  const { data } = props;
  const [open, setOpen] = useState(true);

  return (
    <>
      <ListItem
        disablePadding
        onClick={() => setOpen(!open)}
        className="py-1.5 cursor-pointer"
      >
        <ListItemText>
          <span className="text-sm text-color-gray">{data.name.en}</span>
        </ListItemText>
        {open ? (
          <ExpandMore fontSize="small" className="text-color-gray" />
        ) : (
          <ChevronRight fontSize="small" className="text-color-gray" />
        )}
      </ListItem>
      <Collapse in={open} timeout="auto" unmountOnExit>
        <List disablePadding>
          <div className="pl-5">
            {data.children?.map((item) => (
              <Fragment key={item.id}>
                <ListProductSideBarItemCategoryItemChildren
                  name={item.name.en}
                />
              </Fragment>
            ))}
          </div>
        </List>
      </Collapse>
    </>
  );
};

export default ListProductSideBarItemCategoryItem;
