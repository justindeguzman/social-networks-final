
/*
 * Module dependencies.
 */

var mysql = require('mysql')
var nodeSql = require('nodesql')

/*
 * Setup.
 */

var connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'humhub'
})

var db = nodeSql.createMySqlStrategy(connection)

function getAllNodes (cb) {
  db.query('SELECT * FROM node', cb)
}

function insertNode (node, cb) {
  var params = getQueryParams(node)
  db.query('INSERT INTO node (' + params.columns + ') VALUES (' +
    params.values + ')', cb)
}

function incrementNodeUptime (node, cb) {
  var signifier = node.node_number ? node.node_number : node.name

  if (typeof signifier === 'number') {
    db.query('UPDATE node SET uptime = uptime + 1 WHERE node_number = ' +
      signifier, cb)
  } else {
    db.query('UPDATE node SET uptime = uptime + 1 WHERE name = "' +
      signifier + '"', cb)
  }
}

function getQueryParams (obj) {
  var result = {
    columns: '',
    values: ''
  }

  for (var key in obj) {
    result.columns += key + ','

    var value = obj[key]

    if (typeof value === 'string') {
      result.values += '"' + value + '",'
    } else {
      result.values += value + ','
    }
  }

  result.columns = result.columns.substring(0, result.columns.length - 1)
  result.values = result.values.substring(0, result.values.length - 1)
  return result
}

/*
 * Module exports.
 */

exports.incrementNodeUptime = incrementNodeUptime
exports.insertNode = insertNode
exports.getAllNodes = getAllNodes
