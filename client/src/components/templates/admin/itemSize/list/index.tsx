import React, { FC, useState } from "react";
// @mui
import Card from "@mui/material/Card";
import Table from "@mui/material/Table";
import Stack from "@mui/material/Stack";
import Paper from "@mui/material/Paper";
import Button from "@mui/material/Button";
import TableRow from "@mui/material/TableRow";
import TableBody from "@mui/material/TableBody";
import TableCell from "@mui/material/TableCell";
import Container from "@mui/material/Container";
import Typography from "@mui/material/Typography";
import TableContainer from "@mui/material/TableContainer";
import TablePagination from "@mui/material/TablePagination";
//component
import Iconify from "@/components/shared/iconify";
import Scrollbar from "@/components/shared/scrollbar";
import ListItemSizeHead from "./section/ListHead";
import ListItemSizeToolbar from "./section/ListToolbar";
import Link from "next/link";
import { IAdminItemSize } from "@/interfaces/ItemSize";

import {
  Control,
  SubmitHandler,
  UseFormHandleSubmit,
  Controller,
  UseFormWatch,
} from "react-hook-form";
import { IItemSizeListParams } from "@/pages/admin/item-size";
import ItemSizeRow from "./section/ItemRow";
import LoadingItemSizeCell from "./section/LoadingCell";

const TABLE_HEAD = [
  { id: "id", label: "ID", alignRight: false },
  { id: "value", label: "Value", alignRight: false },
  { id: "item-category-id", label: "Item Category", alignRight: false },
  { id: "item-color-id", label: "Item Color", alignRight: false },
  { id: "status", label: "Status", alignRight: false },
  { id: "" },
];

type OrderByType = "id" | "status";

function descendingComparator(
  a: IAdminItemSize,
  b: IAdminItemSize,
  orderBy: OrderByType
) {
  if (b[orderBy] < a[orderBy]) {
    return -1;
  }
  if (b[orderBy] > a[orderBy]) {
    return 1;
  }
  return 0;
}

function getComparator(order: "asc" | "desc", orderBy: OrderByType) {
  return order === "desc"
    ? (a: IAdminItemSize, b: IAdminItemSize) =>
        descendingComparator(a, b, orderBy)
    : (a: IAdminItemSize, b: IAdminItemSize) =>
        -descendingComparator(a, b, orderBy);
}

function applySortFilter(array: IAdminItemSize[] = [], comparator: any) {
  const stabilizedThis = array.map((el, index) => ({ el, index }));
  stabilizedThis.sort((a, b) => {
    const order = comparator(a.el, b.el);
    if (order !== 0) return order;
    return a.index - b.index;
  });

  return stabilizedThis.map((el) => el.el);
}

interface IListItemSizeTempalte {
  data?: IAdminItemSize[];
  control: Control<IItemSizeListParams, any>;
  handleSubmit: UseFormHandleSubmit<IItemSizeListParams>;
  onSubmit: SubmitHandler<IItemSizeListParams>;
  watch: UseFormWatch<IItemSizeListParams>;
  isLoading: boolean;
}

const ListItemSizeTemplate: FC<IListItemSizeTempalte> = (props) => {
  const { data, control, handleSubmit, onSubmit, watch, isLoading } = props;

  const [order, setOrder] = useState<"asc" | "desc">("asc");

  const [orderBy, setOrderBy] = useState<OrderByType>("id");

  const handleRequestSort = (event: any, property: OrderByType) => {
    const isAsc = orderBy === property && order === "asc";
    setOrder(isAsc ? "desc" : "asc");
    setOrderBy(property);
  };

  const emptyRows =
    watch("page") > 0
      ? Math.max(
          0,
          (1 + watch("page")) * watch("rowPerPage") - (data?.length || 0)
        )
      : 0;
  const filteredUsers = applySortFilter(data, getComparator(order, orderBy));

  const isNotFound = !data?.length && !!watch("search") && !isLoading;

  return (
    <form onSubmit={handleSubmit(onSubmit)}>
      <Container>
        <Stack
          direction="row"
          alignItems="center"
          justifyContent="space-between"
          mb={5}
        >
          <Typography variant="h4" gutterBottom>
            Item Size
          </Typography>
          <Button
            variant="contained"
            startIcon={<Iconify icon="eva:plus-fill" />}
            LinkComponent={Link}
            href="/admin/item-size/create"
          >
            New Item Size
          </Button>
        </Stack>

        <Card>
          <ListItemSizeToolbar control={control} />

          <Scrollbar>
            <TableContainer sx={{ minWidth: 800 }}>
              <Table>
                <ListItemSizeHead
                  order={order}
                  orderBy={orderBy}
                  headLabel={TABLE_HEAD}
                  onRequestSort={handleRequestSort}
                />
                <TableBody>
                  {isLoading
                    ? Array(watch("rowPerPage")).fill(<LoadingItemSizeCell />)
                    : filteredUsers.map((row) => {
                        const {
                          id,
                          status,
                          value,
                          item_category,
                          item_person_type,
                        } = row;

                        return (
                          <ItemSizeRow
                            key={id}
                            id={id}
                            status={status}
                            value={value}
                            item_category={item_category}
                            item_person_type={item_person_type}
                          />
                        );
                      })}
                  {emptyRows > 0 && (
                    <TableRow style={{ height: 53 * emptyRows }}>
                      <TableCell colSpan={6} />
                    </TableRow>
                  )}
                </TableBody>

                {isNotFound && (
                  <TableBody>
                    <TableRow>
                      <TableCell align="center" colSpan={6} sx={{ py: 3 }}>
                        <Paper
                          sx={{
                            textAlign: "center",
                          }}
                        >
                          <Typography variant="h6" paragraph>
                            Not found
                          </Typography>

                          <Typography variant="body2">
                            No results found for &nbsp;
                            <strong>&quot;{watch("search")}&quot;</strong>.
                            <br /> Try checking for typos or using complete
                            words.
                          </Typography>
                        </Paper>
                      </TableCell>
                    </TableRow>
                  </TableBody>
                )}
              </Table>
            </TableContainer>
          </Scrollbar>

          <Controller
            control={control}
            name="rowPerPage"
            render={({
              field: { value: rowPerPageValue, onChange: rowPerPageOnChange },
            }) => (
              <Controller
                control={control}
                name="page"
                render={({ field: { value, onChange } }) => (
                  <TablePagination
                    rowsPerPageOptions={[5, 10, 25]}
                    component="div"
                    count={20}
                    rowsPerPage={rowPerPageValue}
                    page={value}
                    onPageChange={(e, page) => onChange(page)}
                    onRowsPerPageChange={(e) =>
                      rowPerPageOnChange(e.target.value)
                    }
                  />
                )}
              />
            )}
          />
        </Card>
      </Container>
    </form>
  );
};

export default ListItemSizeTemplate;
