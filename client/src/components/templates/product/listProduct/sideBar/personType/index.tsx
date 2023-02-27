import ListItemText from "@mui/material/ListItemText";
import ListItemButton from "@mui/material/ListItemButton";
import List from "@mui/material/List";
import ListItem from "@mui/material/ListItem";

import React, { FC, useState } from "react";
import IGender from "@/interfaces/Gender";

interface IListProductSideBarPersonType {
  data?: IGender[];
}

const ListProductSideBarPersonType: FC<IListProductSideBarPersonType> = (
  props
) => {
  const { data } = props;
  const [selected, setSelected] = useState<number>();

  const handleSelected = (
    event: React.MouseEvent<HTMLElement, MouseEvent>,
    index: number
  ) => {
    setSelected(index);
  };

  return (
    <>
      <h6 className="text-sm font-semibold mb-2.5">Person Type</h6>
      <List disablePadding className="py-1.5">
        {data?.map((item) => (
          <ListItem
            key={item.id}
            disablePadding
            onClick={(e) => handleSelected(e, item.id)}
            className="cursor-pointer py-1.5"
          >
            <ListItemText>
              <span
                className={`text-sm ${
                  selected === item.id
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
    </>
  );
};

export default ListProductSideBarPersonType;
