import { IAdminProduct } from "@/interfaces/Product";
import React, { ChangeEvent, useState, FC } from "react";
import { filter } from "lodash";
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
import ListBrandHead from "./section/ListHead";
import ListBrandToolbar from "./section/ListToolbar";
import Link from "next/link";
import { IProductListParams } from "@/pages/admin/product";
import {
  Control,
  SubmitHandler,
  UseFormHandleSubmit,
  Controller,
  UseFormWatch,
} from "react-hook-form";
import ItemRowItemList from "./section/ItemRow";

const TABLE_HEAD = [
  { id: "id", label: "ID", alignRight: false },
  { id: "name", label: "Name", alighnRight: false },
  { id: "created_at", label: "Create At", alignRight: false },
  { id: "status", label: "Status", alignRight: false },
  { id: "feature", label: "Feature", alignRight: false },
  { id: "show", label: "Show", alignRight: false },
  { id: "" },
];

type OrderByType = "id" | "name" | "status";

function descendingComparator(
  a: IAdminProduct,
  b: IAdminProduct,
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
    ? (a: IAdminProduct, b: IAdminProduct) =>
        descendingComparator(a, b, orderBy)
    : (a: IAdminProduct, b: IAdminProduct) =>
        -descendingComparator(a, b, orderBy);
}

function applySortFilter(
  array: IAdminProduct[] = [],
  comparator: any,
  query: string
) {
  const stabilizedThis = array.map((el, index) => ({ el, index }));
  stabilizedThis.sort((a, b) => {
    const order = comparator(a.el, b.el);
    if (order !== 0) return order;
    return a.index - b.index;
  });
  if (query) {
    return filter(
      array,
      (_user) => _user.name.toLowerCase().indexOf(query.toLowerCase()) !== -1
    );
  }
  return stabilizedThis.map((el) => el.el);
}

interface IListProductTempalte {
  data?: IAdminProduct[];
  control: Control<IProductListParams, any>;
  handleSubmit: UseFormHandleSubmit<IProductListParams>;
  onSubmit: SubmitHandler<IProductListParams>;
  watch: UseFormWatch<IProductListParams>;
}

const ListProductTemplate: FC<IListProductTempalte> = (props) => {
  const { data, control, handleSubmit, onSubmit, watch } = props;

  const [order, setOrder] = useState<"asc" | "desc">("asc");

  const [orderBy, setOrderBy] = useState<OrderByType>("name");

  const [filterName, setFilterName] = useState("");

  const handleRequestSort = (event: any, property: OrderByType) => {
    const isAsc = orderBy === property && order === "asc";
    setOrder(isAsc ? "desc" : "asc");
    setOrderBy(property);
  };

  const handleFilterByName = (event: ChangeEvent<HTMLInputElement>) => {
    setFilterName(event.target.value);
  };

  const emptyRows =
    watch("page") > 0
      ? Math.max(
          0,
          (1 + watch("page")) * watch("rowPerPage") - (data?.length || 0)
        )
      : 0;

  const filteredUsers = applySortFilter(
    data,
    getComparator(order, orderBy),
    filterName
  );

  const isNotFound = !data?.length && !!filterName;

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
            List Product
          </Typography>
          <Button
            LinkComponent={Link}
            variant="contained"
            startIcon={<Iconify icon="eva:plus-fill" />}
            href="/admin/product/create"
          >
            New Product
          </Button>
        </Stack>

        <Card>
          <ListBrandToolbar control={control} />

          <Scrollbar>
            <TableContainer sx={{ minWidth: 800 }}>
              <Table>
                <ListBrandHead
                  order={order}
                  orderBy={orderBy}
                  headLabel={TABLE_HEAD}
                  onRequestSort={handleRequestSort}
                />
                <TableBody>
                  {filteredUsers.map((row) => {
                    const {
                      id,
                      name,
                      slug,
                      status,
                      thumbnail_url,

                      created_at,
                    } = row;

                    return (
                      <ItemRowItemList
                        id={id}
                        name={name}
                        slug={slug}
                        status={status}
                        thumbnail_url={thumbnail_url}
                        created_at={created_at}
                      />
                    );
                  })}
                  {emptyRows > 0 && (
                    <TableRow
                      style={{
                        height:
                          53 * (watch("rowPerPage") / (watch("page") + 1)),
                      }}
                    >
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
                            <strong>&quot;{filterName}&quot;</strong>.
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

export default ListProductTemplate;
